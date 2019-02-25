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
     * ユーザー登録処理
     *
     * @param $request
     */
    public function createUserData($request)
    {
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_BCRYPT),
            'age' => $request->age,
            'status' => config('const.USER_STATUS.MEMBER'),
        ];
        return $this->user->createUsers($user);
    }
}
