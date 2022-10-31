<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->string('mobile_code')->nullable()->nullable();
            $table->string('mobile')->unique();
            $table->integer('country_code')->default('+20');
            $table->text('location')->nullable();
            $table->unsignedBigInteger('government_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('government_id')->references('id')->on('governments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('area_id')->references('id')->on('areas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
