<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccIncomeExpenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_income_expence', function (Blueprint $table) {
            $table->increments('ID ');
            $table->string('VNo');
            $table->string('Student_Id');
            $table->timestamp('Date');
            $table->string('Paymode');
            $table->string('Perpose');
            $table->string('Narration');
            $table->integer('StoreID');
            $table->string('COAID');
            $table->string('Amount');
            $table->integer('IsApprove');
            $table->string('CreateBy');
            $table->timestamp('CreateDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acc_income_expence');
    }
}
