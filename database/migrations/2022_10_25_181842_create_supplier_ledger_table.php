<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_ledger', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_id');
            $table->integer('supplier_id');
            $table->string('chalan_no');
            $table->string('deposit_no');
            $table->integer('amount');
            $table->string('description');
            $table->string('payment_type');
            $table->string('cheque_no');
            $table->string('date');
            $table->integer('status');
            $table->string('d_c');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_ledger');
    }
}
