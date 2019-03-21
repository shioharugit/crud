<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->string('name', 255)->collation('utf8mb4_bin')->nullable()->comment('ユーザー名(半角英字のみ)');
            $table->string('email', 255)->collation('utf8mb4_bin')->comment('メールアドレス(RFC基準)');
            $table->string('password',255 )->collation('utf8mb4_bin')->nullable()->comment('パスワード');
            $table->integer('age')->nullable()->comment('年齢');
            $table->integer('status')->comment('ステータス(0:会員 1:仮会員 9:退会)')->default(0);
            $table->integer('authority')->comment('権限(100:システム管理者 150:管理者 500:一般 900:TEST)')->default(500);
            $table->rememberToken()->comment('パスワードを忘れた方のトークン');
            $table->string('email_verify_token', 100)->collation('utf8_unicode_ci')->comment('本登録用のトークン')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
