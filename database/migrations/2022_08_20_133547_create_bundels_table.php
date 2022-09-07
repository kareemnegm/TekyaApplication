<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->double('price');
            $table->double('offer_price');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('stock_quantity');
            $table->integer('total_weight')->nullable();
            $table->boolean('is_published');
            $table->boolean('is_delivery');
            $table->boolean('is_pickup');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('order')->default(1);
            $table->unsignedBigInteger('shop_id') ;
            $table->foreign('shop_id')->references('id')->on('provider_shop_details')->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('bundels');
    }
}
