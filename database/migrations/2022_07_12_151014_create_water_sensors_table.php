<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_sensors', function (Blueprint $table) {
            $table->id();
            $table->float('current_consumption');
            $table->boolean('status') ;
            $table->time('start_cut_time')->nullable() ;
            $table->time('end_cut_time')->nullable() ;
            $table->UnsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('water_sensors');
    }
};
