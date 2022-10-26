<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccCoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_coa', function (Blueprint $table) {
            $table->id();
            $table->string('HeadCode');
            $table->string('HeadName');
            $table->string('PHeadName');
            $table->integer('HeadLevel');
            $table->integer('IsActive');
            $table->integer('IsTransaction');
            $table->integer('IsGL');
            $table->string('HeadType');
            $table->integer('IsBudget');
            $table->integer('IsDepreciation');
            $table->decimal('DepreciationRate', 18,2);
            $table->timestamps('CreateDate');
            $table->string('CreateBy');
            $table->string('UpdateBy');
            $table->timestamps('UpdateDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acc_coa');
    }
}
