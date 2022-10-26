<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->unsigned()->nullable()->constrained('buildings')->onDelete('cascade');
            $table->string('unit_id')->nullable();
            $table->foreignId('transfer_to')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('cnic')->nullable();
            $table->foreignId('floor_detail_id')->unsigned()->nullable()->constrained('floor_details')->onDelete('cascade');
            /*$table->integer('price')->nullable();*/
            $table->enum('type', ['transfer', 'possession', 'file', 'reserve'])->default('possession');
            $table->enum('status', ['accept', 'rejected', 'pending'])->default('pending');
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
        Schema::dropIfExists('building_requests');
    }
}
