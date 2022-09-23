<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingPaymentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_payment_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_admin_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->integer('total_month_installment')->nullable();
            $table->integer('booking_price')->nullable();
            //$table->integer('form_submission')->nullable();
            $table->integer('per_month_installment')->nullable();
            $table->integer('half_year_installment')->nullable();
            $table->integer('quarterly_payment')->nullable();
            $table->integer('balloting_price')->nullable();
            $table->integer('possession_price')->nullable();
            $table->integer('total_price')->nullable();
            $table->integer('rent_price')->nullable();
            $table->integer('confirmation_amount')->nullable();
            $table->integer('number_of_payment')->nullable();
            $table->integer('premium')->default(0);
            $table->integer('commission')->nullable();
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
        Schema::dropIfExists('building_payment_plans');
    }
}
