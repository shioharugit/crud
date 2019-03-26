<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // システム管理者のみ許可
        Gate::define('systemadmin-only', function ($user) {
            return ($user->authority == config('const.USER_AUTHORITY.SYSTEMADMIN'));
        });
        // 管理者以上（システム管理者&管理者）に許可
        Gate::define('admin-higher', function ($user) {
            return ($user->authority <= config('const.USER_AUTHORITY.ADMIN'));
        });
        // 管理者以下（管理者&一般&TEST）に許可
        Gate::define('admin-lower', function ($user) {
            return ($user->authority >= config('const.USER_AUTHORITY.ADMIN'));
        });
        // 一般以上（システム管理者&管理者&一般）に許可
        Gate::define('user-higher', function ($user) {
            return ($user->authority <= config('const.USER_AUTHORITY.USER'));
        });
        // 一般以下（一般&TEST）に許可
        Gate::define('user-lower', function ($user) {
            return ($user->authority >= config('const.USER_AUTHORITY.USER'));
        });
        // TEST以上（システム管理者&管理者&一般&TEST）に許可
        Gate::define('test-higher', function ($user) {
            return ($user->authority <= config('const.USER_AUTHORITY.TEST'));
        });
    }
}
