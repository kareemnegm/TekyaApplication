<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOderShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oder_shipments', function (Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete()->cascadeOnUpdate();
            
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')->references('id')->on('provider_shop_details')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

            $table->enum('delivery_option',['pickup','delivery']);

            $table->integer('total_items');

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
        Schema::dropIfExists('oder_shipments');
    }
}
