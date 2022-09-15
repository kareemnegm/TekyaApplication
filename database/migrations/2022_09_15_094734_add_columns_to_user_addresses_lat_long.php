<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserAddressesLatLong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->float('longitude', 10, 6)->nullable();
            $table->float('latitude', 10, 6)->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->unsignedBigInteger('government_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas')->cascadeOnUpdate();
            $table->foreign('government_id')->references('id')->on('governments')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('area_id');
            $table->dropConstrainedForeignId('government_id');
            $table->dropColumn('longitude');
            $table->dropColumn('latitude');
         
        });
    }
}
