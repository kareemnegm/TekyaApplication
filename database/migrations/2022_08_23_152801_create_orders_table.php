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
            $table->uuid('order_number')->unique();
            
            $table->enum('order_status',['placed','canceled','delivered'])->default('placed');

            $table->enum('delivery_option',['pickup','delivery']);

            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payment_options')->cascadeOnDelete()->cascadeOnUpdate();

            $table->enum('payment_status',['pending','paid','refund','canceled'])->default('pending');

            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('user_addresses')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

            $table->dateTime('date_order_placed');

            $table->text('order_details') ;

            $table->text('invoices_total')->nullable();

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
