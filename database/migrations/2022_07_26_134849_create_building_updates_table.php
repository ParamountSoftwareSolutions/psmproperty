<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->unsigned()->nullable()->constrained('buildings')->onDelete(null);
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('price')->nullable();
            $table->string('area')->nullable();
            $table->string('address')->nullable();
            $table->text('main_image')->nullable();
            $table->text('banner_images')->nullable();
            $table->text('video')->nullable();
            $table->time('date')->nullable();
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
        Schema::dropIfExists('building_updates');
    }
}
