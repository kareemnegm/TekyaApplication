<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderShopDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_shop_details', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->string('whatsapp_number')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('email')->nullable();
            $table->string('web_site')->nullable();
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('providers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('delivery')->default(1);
            $table->enum('status',['pending','approved'])->default('pending');
            $table->integer('pick_up')->default(1);
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
        Schema::dropIfExists('provider_shop_details');
    }
}
