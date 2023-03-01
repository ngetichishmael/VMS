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
            $table->string('name')->nullable();
            $table->enum('type', ["WalkIn", "DriveIn", "SMS", "ID", 'iPass']);
<<<<<<< HEAD
            $table->foreignIdFor(IdentificationType::class)->nullable();
=======
            $table->foreignIdFor(IdentificationType::class)->nullable();;
>>>>>>> 8a70a8dd6f8f90eb1771b0a45d6ad58a6731ca6f
            $table->foreignIdFor(VisitorType::class)->nullable();;
            $table->foreignIdFor(Purpose::class)->nullable();;
            $table->foreignIdFor(Sentry::class)->nullable();;
            $table->foreignIdFor(Nationality::class)->nullable();;
            $table->foreignIdFor(Resident::class)->nullable();;
            $table->foreignIdFor(UserDetail::class)->nullable();
            $table->foreignIdFor(TimeLog::class);
            $table->string('tag')->nullable();
            $table->binary('attachment1')->nullable();
            $table->binary('attachment2')->nullable();
            $table->binary('attachment3')->nullable();
            $table->binary('attachment4')->nullable();
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
