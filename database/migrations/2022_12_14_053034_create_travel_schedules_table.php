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
        Schema::create('travel_schedules', function (Blueprint $table) {
            $table->id();
            $table->text('bustype');
            $table->time('departure');
            $table->time('est_arrival');
            $table->date('schedule');
            $table->text('est_traveltime');
            $table->text('remarks');
            $table->integer('status')->comment('0 = inactive , 1 = active');
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
        Schema::dropIfExists('travel_schedules');
    }
};
