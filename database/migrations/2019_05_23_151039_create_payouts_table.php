<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('period_id')->unsigned();
            $table->decimal('net_earnings', 8,3);
            $table->decimal('total_author_earnings', 8,3);
            $table->decimal('total_refunds', 8,3);
            $table->string('payout_batch_id')->nullable();
            $table->string('payout_batch_status')->nullable();
            $table->string('gateway')->nullable();
            $table->string('payment_address')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('is_processed')->default(false);
            $table->datetime('processed_at')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('period_id')->references('id')->on('periods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payouts');
    }
}
