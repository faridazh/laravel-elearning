<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar', 510)->nullable();
            $table->string('cover', 510)->nullable();
            $table->tinyText('about')->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender', [0,1,2])->default(0);    // 1=man 2=woman 0=noDisplay
//            $table->enum('agree_term', [0,1])->default(0);       // 1=agree 0=disagree
//            $table->enum('agree_service', [0,1])->default(0);    // 1=agree 0=disagree
            $table->boolean('agree_term')->default(true);
            $table->boolean('agree_service')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
