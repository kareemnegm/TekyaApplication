<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAllBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provider_shop_branches', function (Blueprint $table) {
            $table->string('phone')->nullable()->change();
            $table->text('working_hours_day')->nullable()->change();
            $table->string('street')->nullable()->change();
            $table->unsignedBigInteger('area_id')->nullable()->change();
            $table->unsignedBigInteger('government_id')->nullable()->change();
            $table->float('latitude', 10, 6)->nullable()->change();
            $table->float('longitude', 10, 6)->nullable()->change();
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
            //
        });
    }
}
