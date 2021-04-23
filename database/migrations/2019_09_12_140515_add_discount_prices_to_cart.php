<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscountPricesToCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->decimal('total_purchase_price')->default(0.00)->after('total_price');
        });

        Schema::table('cart_lines', function (Blueprint $table) {
            $table->decimal('purchase_price')->after('unit_price');
            $table->integer('coupon_id')->unsigned()->nullable()->after('purchase_price');
            
            $table->foreign('coupon_id')->references('id')->on('coupons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->dropColumn('total_purchase_price');
        });
        
        Schema::table('cart_lines', function (Blueprint $table) {
            $table->dropForeign(['coupon_id']);
            $table->dropColumn(['purchase_price', 'coupon_id']);
        });
    }
}
