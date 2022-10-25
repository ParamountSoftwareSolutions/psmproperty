<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floor_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->unsigned()->nullable()->constrained('buildings')->onDelete(null);
            $table->foreignId('floor_id')->unsigned()->nullable()->constrained('floors')->onDelete(null);
            $table->foreignId('payment_plan_id')->unsigned()->nullable()->constrained('building_payment_plans')->onDelete(null);
            $table->string('unit_id');
            $table->integer('area');
            $table->enum('size', [1, 2, 3]);
            $table->integer('bath');
            $table->integer('premium')->default(0);
            $table->enum('type', ['studio', 'apartment', 'flat', 'shop', 'penthouse', 'office', ]);
            $table->enum('status', ['available', 'hold', 'sold','token','canceled']);
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
        Schema::dropIfExists('floor_details');
    }
}
