<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderShopBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_shop_branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->boolean('is_head')->default(1);
            $table->boolean('is_active')->default(0);
            $table->string('working_hours_day');
            $table->unsignedBigInteger('branch_address_id');
            $table->unsignedBigInteger('shop_id');
            $table->foreign('branch_address_id')->references('id')->on('branch_addresses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('shop_id')->references('id')->on('provider_shop_details')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('latitude',10,6);
            $table->float('longitude',10,6);

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
        Schema::dropIfExists('provider_shop_branches');
    }
}
