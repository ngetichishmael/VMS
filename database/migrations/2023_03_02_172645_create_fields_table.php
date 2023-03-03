<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->boolean('visitor_type')->default(true);
            $table->boolean('destination')->default(true);
            $table->boolean('tag')->default(true);
            $table->boolean('host')->default(true);
            $table->boolean('purpose_of_visit')->default(true);
            $table->boolean('attachments')->default(true);
            $table->boolean('gender')->default(true);
            $table->boolean('company')->default(true);
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
        Schema::dropIfExists('fields');
    }
}
