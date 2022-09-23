<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgentApartmentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_apartment_details', function (Blueprint $table) {
            $table->id();
            $table->integer('apartment_id');
            $table->string('apartment_type'); //1 room, 2 room etc
            $table->string('apartment_floor');
            $table->string('total_rooms');
            $table->string('area');
            $table->string('down_payment');
            $table->string('per_month_installment');
            $table->string('big_installment');
            $table->string('big_installment_per_year');
            $table->string('total_installments');
            $table->integer('created_by');
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
        Schema::dropIfExists('agent_apartment_details');
    }
}
