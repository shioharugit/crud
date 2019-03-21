<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserListRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService as UserService;

class RegisterController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserService();
    }

    /**
     * 本登録
     *
     * @param $token
     */
    public function register($token)
    {dd($token,'aaaa');
        $user = $this->user->getEditUser($id);
        if (empty($user)) {
            return redirect()->route('user.list');
        }
        return view('user.edit.index', ['user' => $user]);
    }

    /**
     * 本登録確認
     *
     * @param UserEditRequest $request
     */
    public function registerConfirm(UserEditRequest $request)
    {
        return view('user.edit.confirm', ['user' => $request]);
    }

    /**
     * 本登録完了
     *
     * @param UserEditRequest $request
     */
    public function registerComplete(UserEditRequest $request)
    {
        if ('submit' === $request->input('action')) {
            $this->user->editUserData($request);
        } else {
            return redirect()->route('user.edit.index', $request->input('id'))->withInput($request->input);
        }
        return view('user.edit.complete');
    }
}
