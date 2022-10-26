<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankSummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_summary', function (Blueprint $table) {
            $table->string('bank_id');
            $table->string('description');
            $table->string('deposite_id');
            $table->string('date');
            $table->string('ac_type');
            $table->float('dr', 8, 2);
            $table->float('cr', 8, 2);
            $table->string('ammount');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_summary');
    }
}
