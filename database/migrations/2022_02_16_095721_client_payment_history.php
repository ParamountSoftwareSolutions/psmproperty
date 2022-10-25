<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClientPaymentHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_payment_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_id')->references('id')->on('users');
            $table->unsignedInteger('society_id')->references('id')->on('societies');
            $table->string('created_by');
            $table->bigInteger('amount');
            $table->string('method');
            $table->integer('months');
            $table->text('data_array');
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
        Schema::dropIfExists('client_payment_history');
    }
}
