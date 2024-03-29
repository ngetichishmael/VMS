<?php

use App\Models\Device;
use App\Models\Premise;
use App\Models\Shift;
use App\Models\UserDetail;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->string('status')->default(1);
            $table->foreignIdFor(Device::class);
            $table->foreignIdFor(UserDetail::class)->nullable();
            $table->foreignIdFor(Shift::class);
            $table->foreignIdFor(Premise::class);
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
        Schema::dropIfExists('sentries');
    }
}
