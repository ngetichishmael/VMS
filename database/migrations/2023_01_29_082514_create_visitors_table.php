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
            $table->id();
            $table->string('name');
             $table->string('phoneNumber')->nullable(true);
             $table->enum('gender',['male', 'female']);
             $table->enum('type',['drivein','walkin']);
             $table->string('IDNO')->nullable();
             $table->string('purpose');
             $table->date('DOB')->nullable();
             $table->foreignId('organizationId');
             $table->foreignId('premisesId');
             $table->foreignId('vehicleId');
            $table->foreignId('nationalityId');
             $table->foreignId('tagId')->nullable(true);
             $table->string('hostName');
             $table->string('site');
             $table->string('section');
             $table->timestamp('timeIn')->useCurrent();
             $table->timestamp('timeOut')->nullable();
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
        Schema::dropIfExists('visitors');
    }
}
