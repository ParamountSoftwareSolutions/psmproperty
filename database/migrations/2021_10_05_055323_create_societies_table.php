<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('societies', function (Blueprint $table) {
            /*$table->id();
            $table->foreignId('society_admin')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->string('society_name');
            $table->foreignId('society_manager')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('city_id')->unsigned()->nullable()->constrained('cities')->onDelete('cascade');
            $table->foreignId('province_id')->unsigned()->nullable()->constrained('provinces')->onDelete('cascade');
            $table->foreignId('society_type_id')->unsigned()->nullable()->constrained('society_types')->onDelete('cascade');
            $table->foreignId('noc_type_id')->unsigned()->nullable()->constrained('noc_types')->onDelete('cascade');
            $table->string('area');
            $table->string('social_media_accounts_array')->nullable();
            $table->string('images_array');
            $table->longText('details')->nullable();
            $table->status('status');
            $table->timestamps();*/

            $table->id();
            $table->unsignedInteger('user_id')->references('id')->on('users');
            $table->string('owner_name');
            $table->string('society_name');
            $table->unsignedInteger('assign_id')->references('id')->on('users');
            $table->unsignedInteger('city_id')->references('id')->on('cities');
            $table->unsignedInteger('province_id')->references('id')->on('provinces');
            $table->string('address');
            $table->unsignedInteger('society_type_id')->references('id')->on('society_types');
            $table->unsignedInteger('noc_type_id')->references('id')->on('noc_types');
            $table->string('area');
            $table->string('social_media_accounts_array')->nullable();
            $table->string('images_array');
            $table->longText('details')->nullable();
            $table->integer('status_id')->references('id')->on('status');
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
        Schema::dropIfExists('societies');
    }
}
