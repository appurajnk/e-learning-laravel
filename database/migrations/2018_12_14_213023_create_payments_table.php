<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('course_id')->unsigned()->nullable();
            $table->unsignedBigInteger('payer_id');
            $table->integer('coupon_id')->unsigned()->nullable();
            $table->string('payment_method');
            $table->decimal('amount', 8,2);
            $table->string('description');
            $table->decimal('author_earning', 10,2)->nullable();
            $table->decimal('affiliate_earning', 10,2)->nullable();
            $table->string('gateway_payment_id')->nullable();
            $table->integer('referred_by')->nullable();
            $table->integer('transaction_id')->unsigned()->nullable();
            $table->enum('status', ['created', 'refunded', 'finalized'])->default('created');
            $table->datetime('refund_deadline');
            $table->bigInteger('period_id')->unsigned();
            $table->datetime('refunded_at')->nullable();
            $table->timestamps();
            
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('payer_id')->references('id')->on('users');
            $table->foreign('coupon_id')->references('id')->on('coupons');
            $table->foreign('period_id')->references('id')->on('periods');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
