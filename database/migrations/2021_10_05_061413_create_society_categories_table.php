<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocietyCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('society_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('fields_json_array');
            $table->unsignedInteger('created_by')->references('id')->on('users');
            $table->integer('parent_id')->default(-1);
            $table->unsignedInteger('status_id')->references('id')->on('status');
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
        Schema::dropIfExists('society_categories');
    }
}
