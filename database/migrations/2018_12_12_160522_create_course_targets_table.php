<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_targets', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('course_id')->unsigned();
            $table->enum('type', ['requirement', 'what_to_learn', 'target_student']);
            $table->text('text');
            $table->integer('sortOrder')->default(0);
            $table->timestamps();
            
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
        Schema::dropIfExists('course_targets');
    }
}
