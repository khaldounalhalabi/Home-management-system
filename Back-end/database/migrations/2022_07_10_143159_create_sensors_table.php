C<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateSensorsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('sensors', function (Blueprint $table) {
                $table->id();
                $table->boolean('interrupter_status'); //'active'=> 1 , 'disable'=> 0
                $table->float('current_consumption');
                $table->float('allowed_consumption')->nullable();
                $table->float('allowed_consumption_cost')->nullable();
                $table->time('start_cut_time')->nullable();
                $table->time('end_cut_time')->nullable();
                $table->integer('current_voltage');
                $table->time('start_peak_time')->nullable();
                $table->time('end_peak_time')->nullable();

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
            Schema::dropIfExists('sensors');
        }
    }
