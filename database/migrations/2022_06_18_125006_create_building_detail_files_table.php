<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingDetailFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_detail_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_detail_id')->unsigned()->nullable()->constrained('building_details')->onDelete(null);
            //$table->foreignId('floor_image_id')->unsigned()->nullable()->constrained('floors')->onDelete(null');
            $table->text('image')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('building_detail_files');
    }
}
