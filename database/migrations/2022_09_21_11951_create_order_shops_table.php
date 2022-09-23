<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_shops', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnUpdate();
            
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')->references('id')->on('provider_shop_details')->cascadeOnUpdate();


            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices')->cascadeOnUpdate();


            $table->unsignedBigInteger('delivery_option_id');
            $table->foreign('delivery_option_id')->references('delivery_option_id')->on('delivery_options')->cascadeOnUpdate();

            $table->integer('total_items');

            // $table->enum('order_user_status',['placed','canceled','delivered','picked'])->default('placed');

            // $table->enum('order_shop_status',['pending','process','picked','onway','arrived','ready','cancelled'])->default('process');
            $table->text('note')->nullable();

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
        Schema::dropIfExists('order_shops');
    }
}
