<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->string('secondary_phone_number')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('company')->nullable();
            $table->string('ID_number')->nullable();
            $table->binary('image')->nullable();
//            $table->string('KRA_pin')->nullable();
            $table->enum('gender', ['male', 'female', 'Others']);
            $table->string('physical_address')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
