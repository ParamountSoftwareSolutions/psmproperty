<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingPropertyFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_property_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->unsigned()->nullable()->constrained('building_properties')->onDelete('cascade');
            $table->text('image')->default('public/images/property/property.jpg');
            $table->string('type')->default('image');
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
        Schema::dropIfExists('building_property_files');
    }
}
