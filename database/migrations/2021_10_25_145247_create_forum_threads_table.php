<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumThreadsTable extends Migration
{
    public function up()
    {
        Schema::create('forum_threads', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('materi_id')->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyText('name')->unique();
            $table->string('slug', 510)->unique();
            $table->text('content');
            $table->integer('replies')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('forum_threads');
    }
}
