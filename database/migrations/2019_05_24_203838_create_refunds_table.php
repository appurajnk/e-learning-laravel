<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid');
            $table->unsignedBigInteger('requester_id');
            $table->unsignedInteger('payment_id');
            $table->integer('transaction_id')->unsigned()->nullable();
            $table->integer('course_id')->unsigned();
            $table->decimal('amount', 8,3);
            $table->text('comment')->nullable();
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->string('refunded_to')->nullable();
            $table->text('notes')->nullable();
            $table->datetime('processed_at')->nullable();
            $table->timestamps();
            
            $table->foreign('requester_id')->references('id')->on('users');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refunds');
    }
}
