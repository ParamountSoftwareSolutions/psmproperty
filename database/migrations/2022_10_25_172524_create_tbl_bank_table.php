<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_bank', function (Blueprint $table) {
            $table->increments('bankid');
            $table->string('bank_name');
            $table->string('ac_name')->nullable();
            $table->string('ac_number')->nullable();
            $table->string('branch')->nullable();
            $table->string('signature_pic')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_bank');
    }
}
