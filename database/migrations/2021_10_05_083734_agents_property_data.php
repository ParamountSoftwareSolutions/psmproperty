<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgentsPropertyData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_property_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('agent_id')->references('id')->on('agents');
            $table->longText('data_array');
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
        Schema::dropIfExists('agent_property_data');
    }
}
