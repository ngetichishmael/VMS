<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('premisesName');
            $table->string('address');
            $table->string('location');
            $table->string('description');
            $table->string('zone');
            $table->string('type');
            $table->foreignId('organizationId');
            $table->foreignId('lookUpId');
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
        Schema::dropIfExists('premises');
    }
}
