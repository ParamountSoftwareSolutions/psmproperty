<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingSaleHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_sale_histories', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->unsignedBigInteger('building_sale_id');
            $table->foreign('building_sale_id')->references('id')->on('building_sales')->onUpdate('cascade')->onDelete('cascade');
            $table->string('data');
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('building_sale_histories');
    }
}
