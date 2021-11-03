<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseBabsTable extends Migration
{
    public function up()
    {
        Schema::create('course_babs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')->nullable()->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('slug', 510);
            $table->integer('order')->default(1);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_babs');
    }
}
