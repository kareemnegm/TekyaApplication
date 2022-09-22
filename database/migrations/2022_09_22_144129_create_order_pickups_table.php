<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_pickups', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_shop_id');
            $table->foreign('order_shop_id')->references('id')->on('order_shops')->cascadeOnUpdate();

            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('user_addresses')->cascadeOnDelete()->cascadeOnUpdate();

            $table->enum('order_user_status',['placed','canceled','delivered','picked'])->default('placed');

            $table->enum('order_shop_status',['pending','process','picked','onway','arrived','ready','cancelled'])->default('process');

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
        Schema::dropIfExists('order_pickups');
    }
}
