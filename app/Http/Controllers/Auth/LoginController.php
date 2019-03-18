<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/list';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ログイン条件の変更
     *
     * @param Request $request
     */
    public function credentials(Request $request)
    {
        $authConditionsOrigin = $request->only('email', 'password');
        // 会員のみログイン可能
        $authConditionsCustom = array_merge($authConditionsOrigin, ['status' => config('const.USER_STATUS.MEMBER')]);
        return $authConditionsCustom;
    }
}
