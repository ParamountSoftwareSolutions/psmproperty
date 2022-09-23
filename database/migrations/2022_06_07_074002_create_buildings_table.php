<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('building_assign_id')->unsigned()->nullable()->constrained('building_assign_users')->onDelete('cascade');
            //$table->foreignId('property_admin_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            //$table->foreignId('manager_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            //$table->foreignId('sale_manager_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            //$table->foreignId('account_manager_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->text('floor_list');
            $table->text('type');
            $table->text('apartment_size')->nullable();
            $table->string('total_area')->nullable();
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
        Schema::dropIfExists('buildings');
    }
}
