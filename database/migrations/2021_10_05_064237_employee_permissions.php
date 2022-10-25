<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('employee_id')->references('id')->on('society_employees');
            $table->unsignedInteger('society_section_id')->references('id')->on('society_sections');
            $table->boolean('can_view');
            $table->boolean('can_create');
            $table->boolean('can_update');
            $table->boolean('can_delete');
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
        Schema::dropIfExists('employee_permissions');
    }
}
