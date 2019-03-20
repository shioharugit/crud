<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserListRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService as UserService;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserService();
    }

    /**
     * 一覧
     *
     * @param UserListRequest $request
     */
    public function list(UserListRequest $request)
    {
        $users = $this->user->getUsers($request);
        return view('user.list', ['users' => $users, 'request' => $request]);
    }

    /**
     * 登録
     */
    public function register()
    {
        return view('user.register.index');
    }

    /**
     * 登録確認
     *
     * @param UserRegisterRequest $request
     */
    public function registerConfirm(UserRegisterRequest $request)
    {
        return view('user.register.confirm', ['user' => $request]);
    }

    /**
     * 登録完了
     *
     * @param UserRegisterRequest $request
     */
    public function registerComplete(UserRegisterRequest $request)
    {
        if ('submit' === $request->input('action')) {
            $this->user->createUserData($request);
        } else {
            return redirect()->route('user.register.index')->withInput($request->input);
        }
        return view('user.register.complete');
    }

    /**
     * 詳細
     *
     * @param $id
     */
    public function detail($id)
    {
        $user = $this->user->getDetailUser($id);
        if (empty($user)) {
            return redirect()->route('user.list');
        }
        return view('user.detail', ['user' => $user]);
    }

    /**
     * 編集
     *
     * @param $id
     */
    public function edit($id)
    {
        $user = $this->user->getEditUser($id);
        if (empty($user)) {
            return redirect()->route('user.list');
        }
        return view('user.edit.index', ['user' => $user]);
    }

    /**
     * 編集確認
     *
     * @param UserEditRequest $request
     */
    public function editConfirm(UserEditRequest $request)
    {
        return view('user.edit.confirm', ['user' => $request]);
    }

    /**
     * 編集完了
     *
     * @param UserEditRequest $request
     */
    public function editComplete(UserEditRequest $request)
    {
        if ('submit' === $request->input('action')) {
            $this->user->editUserData($request);
        } else {
            return redirect()->route('user.edit.index', $request->input('id'))->withInput($request->input);
        }
        return view('user.edit.complete');
    }
}
