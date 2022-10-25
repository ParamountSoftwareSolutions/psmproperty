<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorDetailFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floor_detail_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('floor_detail_id')->unsigned()->nullable()->constrained('floor_details')->onDelete(null);
            $table->text('image')->default('public/images/building/floor/apartment.png');
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
        Schema::dropIfExists('floor_detail_files');
    }
}
