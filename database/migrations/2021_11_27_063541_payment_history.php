<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_payment_history', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_id');
            $table->bigInteger('amount_per_month');
            $table->bigInteger('total_amount');
            $table->bigInteger('fine_amount')->nullable();
            $table->unsignedInteger('created_by')->references('id')->on('users');
            $table->string('payment_method');
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
        Schema::dropIfExists('installment_payment_history');
    }
}
