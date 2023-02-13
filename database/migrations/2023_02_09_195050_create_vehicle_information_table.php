<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('registration');
            $table->char('type')->nullable();
            $table->char('color')->nullable();
            $table->string('model')->nullable();
            $table->unsignedBigInteger('visitorId');
            $table->timestamps();

            $table->foreign('visitorId')->references('id')->on('visitors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_information');
    }
}
