<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_admin_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->string('building_id');
            $table->Text('description');
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
        Schema::dropIfExists('building_faqs');
    }
}
