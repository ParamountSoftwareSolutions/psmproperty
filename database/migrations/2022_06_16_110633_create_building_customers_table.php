<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_app_id')->unsigned()->nullable()->constrained('building_mobile_applications')->onDelete('cascade');
            $table->foreignId('property_admin_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('building_sale_id')->unsigned()->nullable()->constrained('building_sales')->onDelete('cascade');
            $table->integer('credit')->nullable();
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
        Schema::dropIfExists('building_customers');
    }
}
