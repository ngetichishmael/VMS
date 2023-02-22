<?php

use App\Models\IdentificationType;
use App\Models\Nationality;
use App\Models\Purpose;
use App\Models\Resident;
use App\Models\Sentry;
use App\Models\TimeLog;
use App\Models\UserDetail;
use App\Models\VisitorType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     */

    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ["WalkIn", "DriveIn", "Sms","Manual"]);
            $table->foreignIdFor(IdentificationType::class)->nullable();;
            $table->foreignIdFor(VisitorType::class)->nullable();;
            $table->foreignIdFor(Purpose::class)->nullable();;
            $table->foreignIdFor(Sentry::class)->nullable();;
            $table->foreignIdFor(Nationality::class)->nullable();;
            $table->foreignIdFor(Resident::class)->nullable();;
            $table->foreignIdFor(UserDetail::class)->nullable();
            $table->foreignIdFor(TimeLog::class);
            $table->string('attachment1')->nullable();
            $table->string('attachment2')->nullable();
            $table->string('attachment3')->nullable();
            $table->string('attachment4')->nullable();
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
