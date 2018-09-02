<?php

namespace App\Http\Controllers;

use App\Http\Requests\CsvRequest;
use App\Services\CsvService as CsvService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use SplFileObject;

class CsvController extends Controller
{
    private $csv_import;

    public function __construct()
    {
        $this->csv_import = new CsvService();
    }

    /**
     * CSVインポート画面を表示
     */
    public function index()
    {
        return view('csv.index', ['csv_errors' => old('csv_errors')]);
    }

    /**
     * CSVインポート処理
     *
     * @param CsvRequest $request
     */
    public function import(CsvRequest $request)
    {
        $path = env('DOCUMENT_ROOT').'/crud/storage/app/';

        // ファイル名を現在時刻で設定
        $filename = 'csv_import_'.date('YmdHis').'.csv';

        // 一時領域保存場所にCSVファイルを配置
        $path .= $request->file('csv_file')->storeAs('csv', $filename);

        // CSV読み込み
        $file = new SplFileObject($path);
        $file->setFlags(SplFileObject::READ_CSV);

        // CSVの中身に対するバリデーションを実施
        $csv_errors = $this->csv_import->validateCsvData($file);
        if (count($csv_errors) >= 1) {
            return redirect()->route('csv.index')->withInput(['csv_errors' => $csv_errors]);
        }

        // 登録、編集、削除ごとに配列整形
        $records = $this->csv_import->makeCsvRecords($file);

        // 登録
        if (isset($records[config('const.CSV_TYPE.REGISTER')])) {
            $this->csv_import->createCsvData($records[config('const.CSV_TYPE.REGISTER')]);
        }

        // 編集
        if (isset($records[config('const.CSV_TYPE.EDIT')])) {
            foreach ($records[config('const.CSV_TYPE.EDIT')] as $update_val) {
                $this->csv_import->updateCsvData($update_val['id'], $update_val);
            }
        }

        // 削除
        if (isset($records[config('const.CSV_TYPE.DELETE')])) {
            foreach ($records[config('const.CSV_TYPE.DELETE')] as $delete_val) {
                $this->csv_import->deleteCsvData($delete_val['id'], $delete_val);
            }
        }

        return redirect()->route('csv.index');
    }
}
