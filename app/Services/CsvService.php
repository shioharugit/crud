<?php

namespace App\Services;

use App\Models\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CsvService
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * CSV登録処理
     *
     * @param $data
     */
    public function createCsvData($data)
    {
        return $this->user->createUsers($data);
    }

    /**
     * CSV更新処理
     *
     * @param $id
     * @param $data
     */
    public function updateCsvData($id, $data)
    {
        return $this->user->updateUser($id, $data);
    }

    /**
     * CSV削除処理
     *
     * @param $id
     * @param $data
     */
    public function deleteCsvData($id, $data)
    {
        // 退会に更新する際は、配列から必要なデータのみ抜粋
        $update_data = [
            'status' => $data['status'],
            'updated_at' => $data['updated_at'],
        ];

        return $this->user->updateUser($id, $update_data);
    }

    /**
     * CSVファイル内のバリデーション
     *
     * @param $file readしたCSVファイル
     *
     * @return $csv_errors エラーメッセージの配列
     */
    public function validateCsvData($file)
    {
        // CSVファイルがヘッダー行を除いて最大行以上の場合はエラー
        $file->seek($file->getSize());
        $total = $file->key() - 1;
        if (config('const.CSV_IMPORT_MAX_LINE') < $total) {
            return [\Lang::get('csv_import_validation.csv_import_max_line')];
        }

        // バリデーションルール生成
        $rules = $this->makeCsvValidationRules();

        $csv_errors = [];
        $csv_id_list = [];
        $csv_email_list = [];
        // CSVファイル内のバリデーション
        foreach ($file as $line_num => $line) {
            if (0 === $line_num || 1 === count($line)) {
                // 最初の行または空行など余分な空白がCSVの途中に混ざっている場合は無視
                continue;
            }
            if (count($line) !== count(config('const.CSV_HEADER_NUM'))) {
                $csv_errors = array_merge($csv_errors, ['Line '.$line_num.' カラム数が不正です']);
            }
            // 入力値バリデーション
            $validator = Validator::make($line, $rules, $this->makeCsvValidationMessages($line_num));
            if ($validator->fails()) {
                $csv_errors = array_merge($csv_errors, $validator->errors()->all());
                continue;
            }

            // Validatorで補えないバリデーション
            switch ($line[config('const.CSV_HEADER_NUM.TYPE.INDEX')]) {
                case config('const.CSV_TYPE.EDIT'):
                case config('const.CSV_TYPE.DELETE'):
                    // 編集・削除の場合はID存在チェック
                    if (!$this->user::where('id', $line[config('const.CSV_HEADER_NUM.ID.INDEX')])->exists()) {
                        $csv_errors = array_merge($csv_errors, ['Line '.$line_num.' IDが存在しません']);
                    }
                    break;
            }

            // CSV内でIDが重複していないかチェック
            if ($line[config('const.CSV_HEADER_NUM.ID.INDEX')]) {
                if (!isset($csv_id_list[$line[config('const.CSV_HEADER_NUM.ID.INDEX')]])) {
                    $csv_id_list[$line[config('const.CSV_HEADER_NUM.ID.INDEX')]] = $line[config('const.CSV_HEADER_NUM.ID.INDEX')];
                } else {
                    $csv_errors = array_merge($csv_errors, ['Line '.$line_num.' IDがCSV内で重複しています']);
                }
            }
        }

        return $csv_errors;
    }

    /**
     * CSVファイルの値整形
     *
     * @param $file readしたCSVファイル
     *
     * @return $records 登録・編集・削除用に整形したCSVの値の配列
     */
    public function makeCsvRecords($file)
    {
        $now = date('Y-m-d H:i:s');
        $records = [];
        foreach ($file as $row => $line) {
            if (0 === $row || count($line) !== count(config('const.CSV_HEADER_NUM'))) {
                // 最初の行と、末尾の行や空行といった項目の合わない行は無視
                continue;
            }
            // 決められたヘッダーの個数に沿ってインポートしたCSVを参照していく
            foreach (config('const.CSV_HEADER_NUM') as $val) {
                $type = $line[config('const.CSV_HEADER_NUM.TYPE.INDEX')];
                if (0 === $val['INDEX']) {
                    if (config('const.CSV_TYPE.REGISTER') === $line[$val['INDEX']]) {
                        // 登録の場合
                        $records[$type][$row]['status'] = config('const.USER_STATUS.MEMBER');
                        $records[$type][$row]['created_at'] = $now;
                    } elseif (config('const.CSV_TYPE.EDIT') === $line[$val['INDEX']]) {
                        // 編集の場合
                        $records[$type][$row]['updated_at'] = $now;
                    } elseif (config('const.CSV_TYPE.DELETE') === $line[$val['INDEX']]) {
                        // 削除の場合
                        $records[$type][$row]['status'] = config('const.USER_STATUS.UNSUBSCRIBE');
                        $records[$type][$row]['updated_at'] = $now;
                    }
                } else {
                    // 他のレコードはCSVの内容をそのまま代入
                    $records[$type][$row][$val['NAME']] = !empty($line[$val['INDEX']]) ? $line[$val['INDEX']] : null;
                }
            }
        }

        return $records;
    }

    /**
     * CSVファイル内のバリデーションルール作成
     *
     * @return $rules バリデーションルールの配列
     */
    private function makeCsvValidationRules()
    {
        $rules = [];
        foreach (config('const.CSV_HEADER_NUM') as $val) {
            switch ($val['INDEX']) {
                case config('const.CSV_HEADER_NUM.TYPE.INDEX'):
                    $rules[$val['INDEX']] = 'required|in:'.implode(config('const.CSV_TYPE'), ',');
                    break;
                case config('const.CSV_HEADER_NUM.ID.INDEX'):
                    $rules[$val['INDEX']] = 'nullable|numeric|digits_between:0,10';
                    break;
                case config('const.CSV_HEADER_NUM.NAME.INDEX'):
                    $rules[$val['INDEX']] = 'required|regex:/^[a-zA-Z]+$/|max:255';
                    break;
                case config('const.CSV_HEADER_NUM.EMAIL.INDEX'):
                    $rules[$val['INDEX']] = 'nullable|email|max:255';
                    break;
                case config('const.CSV_HEADER_NUM.PASSWORD.INDEX'):
                    $rules[$val['INDEX']] = 'nullable|regex:/^[0-9a-zA-Z]+$/|between:8,16';
                    break;
                case config('const.CSV_HEADER_NUM.AGE.INDEX'):
                    $rules[$val['INDEX']] = 'nullable|numeric|digits_between:0,2';
                    break;
                default:
                    break;
            }
        }

        return $rules;
    }

    /**
     * CSVファイル内のバリデーションメッセージ作成
     *
     * @param $line_num CSVファイルの該当行
     *
     * @return $messages バリデーションメッセージの配列
     */
    private function makeCsvValidationMessages($line_num)
    {
        $messages = [];
        foreach (config('const.CSV_HEADER_NUM') as $val) {
            switch ($val['INDEX']) {
                case config('const.CSV_HEADER_NUM.TYPE.INDEX'):
                    $messages[$val['INDEX'].'.required'] = 'Line '.$line_num.' '.$val['NAME'].'は必須です';
                    $messages[$val['INDEX'].'.in'] = 'Line '.$line_num.' '.$val['NAME'].'は:valuesの中から入力してください';
                    break;
                case config('const.CSV_HEADER_NUM.ID.INDEX'):
                    $messages[$val['INDEX'].'.numeric'] = 'Line '.$line_num.' '.$val['NAME'].'は半角数字で入力してください';
                    $messages[$val['INDEX'].'.digits_between'] = 'Line '.$line_num.' '.$val['NAME'].'は:max桁以内で入力してください';
                    break;
                case config('const.CSV_HEADER_NUM.NAME.INDEX'):
                    $messages[$val['INDEX'].'.required'] = 'Line '.$line_num.' '.$val['NAME'].'は必須です';
                    $messages[$val['INDEX'].'.regex'] = 'Line '.$line_num.' '.$val['NAME'].'は半角英字で入力してください';
                    $messages[$val['INDEX'].'.max'] = 'Line '.$line_num.' '.$val['NAME'].'は:max文字以内で入力してください';
                    break;
                case config('const.CSV_HEADER_NUM.EMAIL.INDEX'):
                    $messages[$val['INDEX'].'.email'] = 'Line '.$line_num.' '.$val['NAME'].'の形式が不正です';
                    $messages[$val['INDEX'].'.max'] = 'Line '.$line_num.' '.$val['NAME'].'は:max文字以内で入力してください';
                    break;
                case config('const.CSV_HEADER_NUM.PASSWORD.INDEX'):
                    $messages[$val['INDEX'].'.regex'] = 'Line '.$line_num.' '.$val['NAME'].'は半角英数字で入力してください';
                    $messages[$val['INDEX'].'.between'] = 'Line '.$line_num.' '.$val['NAME'].'は:min～:max文字以内で入力してください';
                    break;
                case config('const.CSV_HEADER_NUM.AGE.INDEX'):
                    $messages[$val['INDEX'].'.numeric'] = 'Line '.$line_num.' '.$val['NAME'].'は半角数字で入力してください';
                    $messages[$val['INDEX'].'.digits_between'] = 'Line '.$line_num.' '.$val['NAME'].'は:max桁以内で入力してください';
                    break;
                default:
                    break;
            }
        }

        return $messages;
    }
}
