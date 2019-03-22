<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\RegisterService as RegisterService;

class RegisterController extends Controller
{
    private $register;

    public function __construct()
    {
        $this->register = new RegisterService();
    }

    /**
     * 本登録
     *
     * @param $token
     */
    public function register($token)
    {
        $message = '';
        $user = $this->register->getPreregister($token);

        if (empty($user)) {
            $message = 'このURLは無効です。URLに間違いがないか、お確かめください。';
        }
        return view('register.index', ['user' => $user, 'message' => $message]);
    }

    /**
     * 本登録確認
     *
     * @param RegisterRequest $request
     */
    public function confirm(RegisterRequest $request)
    {
        return view('register.confirm', ['user' => $request]);
    }

    /**
     * 本登録完了
     *
     * @param RegisterRequest $request
     */
    public function complete(RegisterRequest $request)
    {
        if ('submit' === $request->input('action')) {
            $this->register->editPreregister($request);
        } else {
            return redirect()->route('register.index', $request->input('email_verify_token'))->withInput($request->input);
        }
        return view('register.complete');
    }
}
