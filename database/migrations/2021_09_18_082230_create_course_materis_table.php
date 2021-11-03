<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseMaterisTable extends Migration
{
    public function up()
    {
        Schema::create('course_materis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bab_id')->nullable()->constrained('course_babs')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('slug', 510);
            $table->integer('order')->default(1);
            $table->text('content');
            $table->json('files')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_materis');
    }
}
