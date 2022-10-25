<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentSocietyDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_society_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('society_id')->references('id')->on('societies');
            $table->unsignedInteger('agent_id')->references('id')->on('agents');
            $table->unsignedInteger('status_id')->references('id')->on('status');
            $table->softDeletes();
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
        Schema::dropIfExists('agent_society_data');
    }
}
