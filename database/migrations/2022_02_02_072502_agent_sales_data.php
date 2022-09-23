<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgentSalesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_sales_data', function (Blueprint $table) {
            $table->id();
            $table->integer('agent_id');
            $table->integer('type');//1 = property, 2 = society
            $table->integer('society_id');
            $table->integer('property_id');
            $table->string('data_type'); // property, file etc
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
        Schema::dropIfExists('agent_sales_data');
    }
}
