<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->unsigned()->nullable()->constrained('buildings')->onDelete('cascade');
            $table->text('image')->nullable();
            $table->enum('type', ['main', 'normal', 'logo'])->default('normal');
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
        Schema::dropIfExists('building_files');
    }
}
