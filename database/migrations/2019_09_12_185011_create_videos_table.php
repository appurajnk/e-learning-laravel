<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->integer('lesson_id')->unsigned();
            $table->boolean('is_processed')->default(false);
            $table->boolean('encoded')->default(false);
            $table->boolean('processing_succeeded')->nullable();
            $table->string('disk')->default('server');
            $table->string('streamable_sm')->nullable();
            $table->string('streamable_lg')->nullable();
            $table->datetime('converted_for_streaming_at')->nullable();
            $table->string('original_filename')->nullable();
            $table->string('youtube_link')->nullable();
            $table->timestamps();

            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
