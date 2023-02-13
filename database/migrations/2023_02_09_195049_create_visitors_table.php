<?php

use App\Models\IdentificationType;
use App\Models\Nationality;
use App\Models\Purpose;
use App\Models\Resident;
use App\Models\Sentry;
use App\Models\TimeLog;
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
            $table->enum('type', ["WalkIn", "DriveIn"]);
            $table->foreignIdFor(IdentificationType::class);
            $table->foreignIdFor(VisitorType::class);
            $table->foreignIdFor(Purpose::class);
            $table->foreignIdFor(Sentry::class);
            $table->foreignIdFor(Nationality::class);
            $table->foreignIdFor(Resident::class);
            $table->foreignIdFor(TimeLog::class);
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
