<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryCoveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_coverages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')->references('id')->on('provider_shop_details')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('government_id');
            $table->foreign('government_id')->references('id')->on('governments')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')->on('areas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('average_delivery_time');
            $table->double('delivery_fees');
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
        Schema::dropIfExists('delivery_coverages');
    }
}
