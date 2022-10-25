<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingAssignUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_assign_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->unsigned()->nullable()->constrained('buildings')->onDelete(null);
            $table->foreignId('user_id')->unsigned()->nullable()->constrained('users')->onDelete(null);
            /*$table->foreignId('manager_id')->unsigned()->nullable()->constrained('users')->onDelete(null);
            $table->foreignId('sale_manager_id')->unsigned()->nullable()->constrained('users')->onDelete(null);
            $table->foreignId('account_manager_id')->unsigned()->nullable()->constrained('users')->onDelete(null);*/
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
        Schema::dropIfExists('building_assign_users');
    }
}
