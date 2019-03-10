<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService as UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserService();
    }

    public function list(Request $request)
    {
        $items = DB::select('select * from users');
        return view('user.list', ['items' => $items]);
    }

    public function register(Request $request)
    {
        return view('user.register.index');
    }

    public function registerConfirm(UserRegisterRequest $request)
    {
        return view('user.register.confirm', ['user' => $request]);
    }

    public function registerComplete(UserRegisterRequest $request)
    {
        if ('submit' === $request->input('action')) {
            $this->user->createUserData($request);
        } else {
            return redirect()->route('user.register.index')->withInput($request->input);
        }
        
        return view('user.register.complete');
    }
}
