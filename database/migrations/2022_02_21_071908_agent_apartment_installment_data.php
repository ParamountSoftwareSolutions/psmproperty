<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgentApartmentInstallmentData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_apartment_installment_data', function (Blueprint $table) {
            $table->id();
            $table->integer('apartment_sales_id');
            $table->string('installment_amount');
            $table->string('status_id');
            $table->date('due_date');
            $table->string('fine_amount');
            $table->string('payment_mode');
            $table->string('comments');
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
        Schema::dropIfExists('agent_apartment_installment_data');
    }
}
