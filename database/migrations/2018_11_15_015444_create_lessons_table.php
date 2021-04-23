<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('section_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->string('lesson_type')->default('lecture');
            $table->string('title');
            $table->text('description')->nullable();

            $table->enum('content_type', ['video', 'youtube', 'article', 'quiz'])->nullable();
            $table->decimal('duration')->default(0);
            $table->text('article_body')->nullable();
            $table->boolean('preview')->default(false);
            $table->integer('sortOrder');
            $table->timestamps();
            
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
