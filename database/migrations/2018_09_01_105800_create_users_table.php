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
            $table->string('name')->collation('utf8_unicode_ci')->comment('ユーザー名(半角英字のみ)');
            $table->string('email')->collation('utf8_unicode_ci')->comment('メールアドレス(RFC基準)');
            $table->string('password')->collation('utf8_unicode_ci')->nullable()->comment('パスワード');
            $table->integer('age')->nullable()->comment('年齢');
            $table->integer('status')->comment('ステータス(0:会員 1:仮会員 9:退会)');
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
