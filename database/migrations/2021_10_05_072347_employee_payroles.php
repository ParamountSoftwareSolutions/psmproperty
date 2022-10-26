<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeePayroles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_pay_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('employee_id')->references('id')->on('society_employees');
            $table->unsignedInteger('created_by')->references('id')->on('users');
            $table->date('date');
            $table->string('amount');
            $table->string('payment_mode');
            $table->string('comments');
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
        Schema::dropIfExists('employee_pay_roles');
    }
}
