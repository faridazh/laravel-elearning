<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->boolean('primary')->default(1);                                 // 0 || 1 (true || false) == primary or secondary
            $table->boolean('premium')->default(0);                                 // 0 || 1 (true || false)
            $table->string('bg_color')->default('#ffffff');       // HEX. RGBA and HSLA color code
            $table->string('text_color')->default('#000000');     // HEX. RGBA and HSLA color code
            $table->string('icon')->nullable();                         // FontAwesome 5 Free Icon
            $table->boolean('candelete')->default(1);                               // 0 || 1 (true || false)
            $table->timestamps();
        });

        Artisan::call('db:seed', array('--class' => 'RoleSeeder'));
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
