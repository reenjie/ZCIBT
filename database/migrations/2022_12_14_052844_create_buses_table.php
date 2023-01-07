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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->text('Bus_No')->unique();
            $table->integer('seating_capacity');
            $table->text('company')->nullable();
            $table->text('weight')->nullable();
            $table->text('color')->nullable();
            $table->integer('per_column');
            $table->integer('per_row');
            $table->text('bustype');
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
        Schema::dropIfExists('buses');
    }
};
