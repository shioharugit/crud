<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'status',
        'authority',
        'created_at',
        'updated_at',
    ];

    /**
     * users登録処理(複数登録)
     *
     * @param $data
     */
    public function createUsers($data)
    {
        return User::insert($data);
    }

    /**
     * users更新処理
     *
     * @param $id
     * @param $data
     */
    public function updateUser($id, $data)
    {
        // 仮登録、system管理者、TESTユーザーは変更不可なので取得させない
        return User::where('id', $id)
            ->where('status', '!=', config('const.USER_STATUS.PROVISIONAL_MEMBER'))
            ->where('authority', '!=', config('const.USER_AUTHORITY.SYSTEMADMIN'))
            ->where('authority', '!=', config('const.USER_AUTHORITY.TEST'))
            ->update($data);
    }

    /**
     * users取得処理
     *
     * @param $id
     * @param $authority
     * @param $status
     */
    public function getDetailUser($id, $authority, $status)
    {
        return User::where('id', $id)
            ->where('authority', '>=', $authority)
            ->whereIn('status', $status)
            ->first();
    }

    /**
     * 編集用のusers取得処理
     *
     * @param $id
     */
    public function getEditUser($id)
    {
        // 仮登録、system管理者、TESTユーザーは変更不可なので取得させない
        return User::where('id', $id)
            ->where('status', '!=', config('const.USER_STATUS.PROVISIONAL_MEMBER'))
            ->where('authority', '!=', config('const.USER_AUTHORITY.SYSTEMADMIN'))
            ->where('authority', '!=', config('const.USER_AUTHORITY.TEST'))
            ->first();
    }

    /**
     * 本登録用のusers取得処理
     *
     * @param $email_verify_token
     */
    public function getPreregister($email_verify_token)
    {
        // トークンが一致するステータスが仮登録のユーザーのみ取得
        return User::where('email_verify_token', $email_verify_token)
            ->where('status', config('const.USER_STATUS.PROVISIONAL_MEMBER'))
            ->first();
    }

    /**
     * 本登録用のusers更新処理
     *
     * @param $email_verify_token
     * @param $data
     */
    public function updatePreregister($email_verify_token, $data)
    {
        // トークンが一致するステータスが仮登録のユーザーであり、
        // system管理者、TESTユーザーは変更不可なので取得させない
        return User::where('email_verify_token', $email_verify_token)
            ->where('status', config('const.USER_STATUS.PROVISIONAL_MEMBER'))
            ->where('authority', '!=', config('const.USER_AUTHORITY.SYSTEMADMIN'))
            ->where('authority', '!=', config('const.USER_AUTHORITY.TEST'))
            ->update($data);
    }
}
