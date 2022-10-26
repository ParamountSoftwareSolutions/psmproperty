<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SocietySales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('society_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('society_id')->references('id')->on('societies');
            $table->unsignedInteger('society_cat_data_id')->references('id')->on('society_category_data');
            $table->unsignedInteger('created_by')->references('id')->on('users');
            $table->unsignedInteger('sold_to_id')->references('id')->on('users');
            $table->integer('plot_size');
            $table->string('plot_number')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('status_id')->references('id')->on('status');
            $table->date('date')->nullable();
            $table->string('amount')->nullable();
            $table->string('comments')->nullable();
            $table->integer('total_installment');
            $table->integer('processing_fee');
            $table->integer('monthly_installments');
            $table->integer('mid_term_installment');
            $table->integer('mid_term_per_year');
            $table->integer('possession_fee');
            $table->integer('belting_fee');
            $table->integer('down_payment');
            $table->string('registration_number');
            $table->integer('hidden_file_number');
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
        Schema::dropIfExists('society_sales');
    }
}
