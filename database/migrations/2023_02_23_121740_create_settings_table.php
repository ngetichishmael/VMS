<?php

use App\Models\Field;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('organization_code');
            $table->boolean('id_checkin')->default(false);
            $table->boolean('automatic_id_checkin')->default(false);
            $table->boolean('sms_checkin')->default(false);
            $table->boolean('ipass_checkin')->default(false);
            $table->boolean('returning_visitor')->default(false);
            $table->foreignIdFor(Field::class)->nullable();;

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
        Schema::dropIfExists('settings');
    }
}
