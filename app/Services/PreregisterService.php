<?php

namespace App\Services;

use App\Models\User as User;
use DB;
use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;

class PreregisterService
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * 仮登録処理
     *
     * @param $request
     */
    public function createPreregisterData($request)
    {
        $now = date(config('const.DEFAULT_DATE_FORMAT'));
        $user = [
            'email' => $request->email,
            'status' => config('const.USER_STATUS.PROVISIONAL_MEMBER'),
            'email_verify_token' => base64_encode($request->email),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        DB::beginTransaction();
        try {
            // 仮登録データが存在しない場合のみ仮登録データを作成
            if($this->user->where('email', $request->email)->where('status', config('const.USER_STATUS.PROVISIONAL_MEMBER'))->doesntExist()) {
                $this->user->createUsers($user);
            }
            $email = new EmailVerification($user);
            Mail::to([$user['email']])->send($email);
        } catch(\Exception $e) {
            DB::rollback();
            Log::error('仮登録中に例外が発生しました:'.$e->getMessage());
            abort(500);
        }
        DB::commit();
    }
}
