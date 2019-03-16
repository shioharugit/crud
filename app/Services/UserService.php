<?php

namespace App\Services;

use App\Models\User as User;
use DB;
use Log;
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
        $query = $this->user->query()->where('authority', '>=', Auth::user()->authority);

        if(!empty($request->input('name'))) {
            $query->where('name', 'like', '%'.$request->input('name').'%');
        }
        if(!empty($request->input('email'))) {
            $query->where('email', 'like', '%'.$request->input('email').'%');
        }
        if(!empty($request->input('age'))) {
            $query->where('age', $request->input('age'));
        }
        return $query->paginate(10);
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

        DB::beginTransaction();
        try {
            $this->user->createUsers($user);
        } catch(\Exception $e) {
            DB::rollback();
            Log::error('ユーザー登録中に例外が発生しました:'.$e->getMessage());
            abort(500);
        }
        DB::commit();
    }

    /**
     * ユーザー詳細取得処理
     *
     * @param $id
     */
    public function getDetailUser($id)
    {
        return $this->user->getDetailUser($id, Auth::user()->authority);
    }

    /**
     * ユーザー編集用の詳細取得処理
     *
     * @param $id
     */
    public function getEditUser($id)
    {
        return $this->user->getEditUser($id);
    }

    /**
     * ユーザー編集処理
     *
     * @param $request
     */
    public function editUserData($request)
    {
        $now = date(config('const.DEFAULT_DATE_FORMAT'));
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'authority' => $request->authority,
            'updated_at' => $now,
        ];
        if (!empty($request->password)) {
            $user['password'] = password_hash($request->password, PASSWORD_BCRYPT);
        }

        DB::beginTransaction();
        try {
            $this->user->updateUser($request->id, $user);
        } catch(\Exception $e) {
            DB::rollback();
            Log::error('ユーザー更新中に例外が発生しました:'.$e->getMessage());
            abort(500);
        }
        DB::commit();
    }
}
