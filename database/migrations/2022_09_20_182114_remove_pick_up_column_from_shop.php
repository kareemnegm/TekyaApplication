<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePickUpColumnFromShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provider_shop_details', function (Blueprint $table) {
            $table->dropColumn('delivery');
            $table->dropColumn('pick_up');

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
            //
        });
    }
}
