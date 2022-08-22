<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_summeries', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_name')->nullable();
            $table->integer('card_total');
            $table->integer('discount_amount')->default(0);
            $table->integer('sub-total');
            $table->integer('shipping');
            $table->integer('grand_total');
            $table->integer('payment_option');
            $table->integer('payment_status')->default(0);
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_summeries');
    }
};
