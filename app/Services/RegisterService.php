<?php

namespace App\Services;

use App\Models\User as User;
use DB;
use Log;
use Illuminate\Http\Request;

class RegisterService
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * 本登録用の詳細取得処理
     *
     * @param $email_verify_token
     */
    public function getPreregister($email_verify_token)
    {
        return $this->user->getPreregister($email_verify_token);
    }

    /**
     * 仮登録を本登録に編集する
     *
     * @param $request
     */
    public function editPreregister($request)
    {
        $now = date(config('const.DEFAULT_DATE_FORMAT'));
        $user = [
            'name' => $request->name,
            'password' => password_hash($request->password, PASSWORD_BCRYPT),
            'age' => $request->age,
            'authority' => config('const.USER_AUTHORITY.USER'),
            'status' => config('const.USER_STATUS.MEMBER'),
            'updated_at' => $now,
        ];

        DB::beginTransaction();
        try {
            $this->user->updatePreregister($request->email_verify_token, $user);
        } catch(\Exception $e) {
            DB::rollback();
            Log::error('本登録中に例外が発生しました:'.$e->getMessage());
            abort(500);
        }
        DB::commit();
    }
}
