<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingExpenseLaborsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_expense_labors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_expense_id')->unsigned()->nullable()->constrained('building_expenses')->onDelete('cascade');
            $table->integer('labor');
            $table->integer('cost');
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
        Schema::dropIfExists('building_expense_labors');
    }
}
