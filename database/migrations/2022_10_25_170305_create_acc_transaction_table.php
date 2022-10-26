<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_transaction', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('VNo')->nullable();
            $table->string('Vtype')->nullable();
            $table->timestamp('VDate')->useCurrent()->nullable();
            $table->integer('COAID');
            $table->string('Narration')->nullable();
            $table->decimal('Debit', 18,2)->nullable();
            $table->decimal('Credit', 18,2)->nullable();
            $table->integer('StoreID')->nullable();
            $table->string('IsPosted')->nullable();
            $table->string('CreateBy')->nullable();
            $table->timestamp('CreateDate')->useCurrent();
            $table->string('UpdateBy');
            $table->timestamp('UpdateDate')->useCurrent()->nullable();
            $table->string('IsAppove')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acc_transaction');
    }
}
