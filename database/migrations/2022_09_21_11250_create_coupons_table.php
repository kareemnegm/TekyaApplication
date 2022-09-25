<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')->references('id')->on('provider_shop_details')->cascadeOnUpdate();

            $table->string("coupon_name")->unique();
            // The description of the voucher - Not necessary 
            $table->text( 'description' )->nullable( );

            $table->boolean('is_fixed')->default(true);

            $table->integer("discount_amount");

            $table->integer("discount_cap")->nullable();

            // The max uses this coupons has
            $table->integer('max_uses')->unsigned()->nullable();

            // The number of uses currently
             $table->integer('uses')->unsigned( )->nullable( );

            // How many times a user can use this coupons.
            $table->integer('max_uses_user')->unsigned( )->nullable( );

            // When the coupons begins
            $table->dateTime('starts_at');

            // When the coupons ends
            $table->dateTime('expires_at');

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
        Schema::dropIfExists('coupons');
    }
}
