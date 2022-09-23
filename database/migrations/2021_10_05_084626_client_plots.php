<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClientPlots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_plots', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_id')->references('id')->on('clients');
            $table->unsignedInteger('society_id')->references('id')->on('societies');
            $table->unsignedInteger('agent_id')->references('id')->on('users');
            $table->string('plot_number');
            $table->string('plot_size')->nullable();
            $table->string('amount')->nullable();
            $table->unsignedInteger('status_id')->references('id')->on('status');
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('client_plots');
    }
}
