<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDeliveryOptionsToShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provider_shop_details', function (Blueprint $table) {
            $table->integer('delivery')->default(1);
            $table->integer('pick_up')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provider_shop_details', function (Blueprint $table) {
            $table->dropColumn(['delivery', 'pick_up']);
        });
    }
}
