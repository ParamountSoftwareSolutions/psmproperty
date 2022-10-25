<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('father_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('phone_number')->unique()->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('profile_pic_url')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('notification_token')->nullable();
            $table->integer('society')->nullable();
            $table->integer('building')->nullable();
            $table->integer('project')->nullable();
            $table->integer('cnic')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('device_token')->nullable();
            $table->string('server_key')->nullable();
            //$table->integer('property_admin_id')->unsigned();
            //$table->foreign('property_admin_id')->references('id')->on('users');
            $table->foreignId('property_admin_id')->unsigned()->nullable()->constrained('users')->onDelete(null);
            $table->string('dob')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
