<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SocietyInstallmentData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('society_installment_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('society_sales_id')->references('id')->on('society_sales');
            $table->string('installment_amount');
            $table->string('status_id')->references('id')->on('status');
            $table->unsignedInteger('created_by')->references('id')->on('users');
            $table->date('due_date');
            $table->string('fine_amount')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('society_installment_data');
    }
}
