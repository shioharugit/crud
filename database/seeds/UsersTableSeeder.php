<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date(config('const.DEFAULT_DATE_FORMAT'));
        $param = [
            [
                'name' => 'systemadmin',
                'email' => 'systemadmin@example.com',
                'password' => password_hash('password', PASSWORD_BCRYPT),
                'age' => 20,
                'status' => config('const.USER_STATUS.MEMBER'),
                'authority' => config('const.USER_AUTHORITY.SYSTEMADMIN'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => password_hash('password', PASSWORD_BCRYPT),
                'age' => 20,
                'status' => config('const.USER_STATUS.MEMBER'),
                'authority' => config('const.USER_AUTHORITY.ADMIN'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'user',
                'email' => 'user@example.com',
                'password' => password_hash('password', PASSWORD_BCRYPT),
                'age' => 20,
                'status' => config('const.USER_STATUS.MEMBER'),
                'authority' => config('const.USER_AUTHORITY.USER'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'test',
                'email' => 'test@example.com',
                'password' => password_hash('password', PASSWORD_BCRYPT),
                'age' => 20,
                'status' => config('const.USER_STATUS.MEMBER'),
                'authority' => config('const.USER_AUTHORITY.TEST'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        DB::table('users')->insert($param);
    }
}
