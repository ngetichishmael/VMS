<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phoneNumber')->nullable();
            $table->enum('gender', ['male','female']);
            $table->enum('type', ['drivein', 'walkin']);
            $table->string('IDNO');
            $table->string('purpose');
            $table->date('DOB')->nullable();
            $table->unsignedBigInteger('organizationId');
            $table->unsignedBigInteger('premisesId');
            $table->unsignedBigInteger('vehicleId')->nullable();
            $table->unsignedBigInteger('nationalityId');
            $table->unsignedBigInteger('tagId');
            $table->unsignedBigInteger('visitorTypeId');
            $table->string('hostName')->nullable();
            $table->string('site');
            $table->string('section');
            $table->timestamp('timeIn')->useCurrent();
            $table->timestamp('timeOut')->nullable();
            $table->timestamps();

            $table->foreign('organizationId')->references('id')->on('organizations');
            $table->foreign('premisesId')->references('id')->on('premises');
            $table->foreign('vehicleId')->references('id')->on('vehicle_information');
            $table->foreign('nationalityId')->references('id')->on('nationality');
            $table->foreign('tagId')->references('id')->on('tags')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
