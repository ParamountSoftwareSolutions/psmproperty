<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->unsigned()->nullable()->constrained('buildings')->onDelete('cascade');
            $table->foreignId('user_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('sale_manager_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->string('cnic')->unique();
            $table->string('address')->nullable();
            $table->string('account_no')->nullable();
            $table->integer('salary')->nullable();
            $table->integer('commission')->nullable();
            $table->text('document')->nullable();
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
        Schema::dropIfExists('building_employees');
    }
}
