<?php

namespace App\Services;

use App\Models\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * ユーザー一覧処理
     *
     * @param $request
     */
    public function getUsers($request)
    {
        $query = $this->user->query();

        if(!empty($request->input('name'))) {
            $query->where('name', 'like', '%'.$request->input('name').'%');
        }
        if(!empty($request->input('email'))) {
            $query->where('email', 'like', '%'.$request->input('email').'%');
        }
        if(!empty($request->input('age'))) {
            $query->where('age', $request->input('age'));
        }
        return $query->paginate(20);
    }
    
    /**
     * ユーザー登録処理
     *
     * @param $request
     */
    public function createUserData($request)
    {
        $now = date(config('const.DEFAULT_DATE_FORMAT'));
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_BCRYPT),
            'age' => $request->age,
            'status' => config('const.USER_STATUS.MEMBER'),
            'created_at' => $now,
            'updated_at' => $now,
        ];
        return $this->user->createUsers($user);
    }

    /**
     * ユーザー詳細取得処理
     *
     * @param $id
     */
    public function getUser($id)
    {
        return $this->user->getUser($id);
    }

    /**
     * ユーザー編集処理
     *
     * @param $request
     */
    public function updateUserData($request)
    {
        $now = date(config('const.DEFAULT_DATE_FORMAT'));
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'updated_at' => $now,
        ];
        if (!empty($request->password)) {
            $user['password'] = password_hash($request->password, PASSWORD_BCRYPT);
        }
        return $this->user->updateUser($request->id, $user);
    }
}
