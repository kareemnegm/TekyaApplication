<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_shipment_id');
            $table->foreign('order_shipment_id')->references('id')->on('oder_shipments')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('coupon_id')->nullable();
        
            $table->enum('status',['pending','paid','refund','canceled'])->default('pending');

            $table->double('discount');
            $table->double('shipment_fees');
            $table->double('total_product_price');
            $table->double('total_invoice');
            
            $table->dateTime('invoice_date');

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
        Schema::dropIfExists('invoices');
    }
}
