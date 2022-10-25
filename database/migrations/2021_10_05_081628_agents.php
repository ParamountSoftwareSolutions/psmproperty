<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Agents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('business_address');
            $table->string('business_name');
            $table->string('images_array');
            $table->longText('details');
            $table->unsignedInteger('city_id')->references('id')->on('cities');
            $table->unsignedInteger('province_id')->references('id')->on('provinces');
            $table->string('contact_number');
            $table->string('whatsapp_number');
            $table->string('social_media_accounts_array');
            $table->string('registration_number');
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
        Schema::dropIfExists('agents');
    }
}
