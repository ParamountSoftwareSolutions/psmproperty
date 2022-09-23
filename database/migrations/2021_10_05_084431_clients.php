<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->references('id')->on('users');
            $table->integer('society_id')->references('id')->on('societies');
            $table->integer('agent_id')->references('id')->on('agents');
            $table->string('membership_number')->nullable();
            $table->string('cnic');
            $table->longText('details')->nullable();
            $table->unsignedInteger('city_id')->references('id')->on('cities');
            $table->unsignedInteger('province_id')->references('id')->on('provinces');
            $table->string('address');
            $table->string('whatsapp_number')->nullable();
            $table->string('social_media_accounts_array')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
