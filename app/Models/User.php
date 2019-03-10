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
        return User::where('id', $id)->update($data);
    }

    /**
     * user取得処理
     *
     * @param $id
     */
    public function getUser($id)
    {
        return User::where('id', $id)->first();
    }

}
