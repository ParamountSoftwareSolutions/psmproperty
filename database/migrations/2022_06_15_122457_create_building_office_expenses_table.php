<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingOfficeExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_office_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->unsigned()->nullable()->constrained('buildings')->onDelete('cascade');
            $table->enum('category', ['electricity_bill', 'utility_bill', 'landline', 'internet_bill', 'general', 'accessories', 'stationary', 'equipments', 'furniture'])->nullable();
            $table->integer('cost')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('building_office_expenses');
    }
}
