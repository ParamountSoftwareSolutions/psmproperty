<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocietyCategoryDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('society_category_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('society_id')->references('id')->on('societies');
            $table->unsignedInteger('category_id')->references('id')->on('society_categories');
            $table->string('category_name');
            $table->unsignedInteger('created_by')->references('id')->on('users');
            $table->unsignedInteger('status_id')->references('id')->on('status');
            $table->longText('data_array');
            $table->softDeletes();
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
        Schema::dropIfExists('society_category_data');
    }
}
