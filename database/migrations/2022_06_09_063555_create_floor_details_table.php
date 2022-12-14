<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floor_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->unsigned()->nullable()->constrained('buildings')->onDelete('cascade');
            $table->foreignId('floor_id')->unsigned()->nullable()->constrained('floors')->onDelete('cascade');
            $table->string('unit_id');
            $table->integer('area');
            $table->enum('size', [1, 2, 3]);
            $table->integer('bath');
            $table->string('premium')->nullable();
            $table->integer('total_month_installment')->nullable();
            $table->integer('booking_price')->nullable();
            $table->integer('form_submission')->nullable();
            $table->integer('per_month_installment')->nullable();
            $table->integer('half_year_installment')->nullable();
            $table->integer('quarterly_payment')->nullable();
            $table->integer('balloting_price')->nullable();
            $table->integer('possession_price')->nullable();
            $table->integer('total_price')->nullable();
            $table->enum('type', ['studio', 'apartment', 'flat', 'shop', 'penthouse', 'office', ]);
            $table->enum('status', ['available', 'hold', 'sold']);
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
        Schema::dropIfExists('floor_details');
    }
}
