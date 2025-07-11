<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate();

            $table->bigInteger('order_number')->unique();

            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payment_options')->cascadeOnUpdate();

            $table->unsignedBigInteger('order_invoice_id')->nullable();
            $table->foreign('order_invoice_id')->references('id')->on('order_invoices')->cascadeOnUpdate();

            $table->dateTime('date_order_placed');

            $table->integer('total_items');
            
            $table->integer('total_shop');

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
        Schema::dropIfExists('orders');
    }
}
