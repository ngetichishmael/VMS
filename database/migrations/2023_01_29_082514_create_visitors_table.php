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
            $table->string('firstName');
            $table->string('middleName')->nullable(true);
             $table->string('lastName');
             $table->string('phoneNumber');
             $table->enum('gender',['male', 'female']);
             $table->enum('visitortype',['drivein','walkin']);
             $table->foreignId('nationalityId');
             $table->string('IDNO');
             $table->string('purpose');
             $table->string('DOB')->nullable();
             $table->foreignId('organizationId');
             $table->foreignId('premisesId');
             $table->foreignId('tagId');
             $table->string('hostName');
             $table->timestamp('timeIn')->useCurrent();;
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
