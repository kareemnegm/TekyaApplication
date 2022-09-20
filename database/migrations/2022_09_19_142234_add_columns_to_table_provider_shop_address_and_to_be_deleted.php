<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTableProviderShopAddressAndToBeDeleted extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provider_shop_branches', function (Blueprint $table) {
            // $table->string('address')->nullable();
            // $table->string('street')->nullable();
            // $table->string('address_details')->nullable();
            // $table->string('nearest_landmark')->nullable();
            // $table->text('notes')->nullable();
            $table->integer('delivery')->default(1);
            $table->integer('pick_up')->default(1);
            // $table->dropConstrainedForeignId('branch_address_id');
            // $table->unsignedBigInteger('area_id')->nullable();
            // $table->unsignedBigInteger('government_id')->nullable();
            // $table->foreign('area_id')->references('id')->on('areas')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->foreign('government_id')->references('id')->on('governments')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provider_shop_branches', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('street');
            $table->dropColumn('address_details');
            $table->dropColumn('nearest_landmark');
            $table->dropColumn('notes');
            $table->integer('delivery');
            $table->integer('pick_up');
            $table->dropConstrainedForeignId('area_id');
            $table->dropConstrainedForeignId('government_id');

        });
    }
}
