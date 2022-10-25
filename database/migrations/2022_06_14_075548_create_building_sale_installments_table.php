<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingSaleInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_sale_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('floor_detail_id')->unsigned()->nullable()->constrained('floor_details')->onDelete(null);
            $table->foreignId('building_sale_id')->unsigned()->nullable()->constrained('building_sales')->onDelete(null);
            $table->string('title');
            $table->integer('installment_amount');
            $table->date('due_date')->nullable();
            $table->integer('fine_amount')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('comments')->nullable();
            $table->enum('type', ['installment', 'rent']);
            $table->enum('status', ['paid', 'not_paid']);
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
        Schema::dropIfExists('building_sale_installments');
    }
}
