<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SocietyEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('society_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('society_id')->references('id')->on('societies');
            $table->unsignedInteger('user_id')->references('id')->on('users');
            $table->unsignedInteger('status_id')->references('id')->on('status');
            $table->unsignedInteger('created_by')->references('id')->on('users');
            $table->unsignedInteger('job_title_id')->references('id')->on('job_titles');
            $table->string('employee_id')->unique();
            $table->string('cnic')->unique();;
            $table->string('documents');
            $table->string('address');
            $table->string('account_no');
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
        Schema::dropIfExists('society_employees');
    }
}
