<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            /*$table->foreignId('property_admin_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('manager_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('sale_manager_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('account_manager_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');*/
            $table->string('title')->nullable();
            $table->string('size')->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('bath')->nullable();
            $table->string('bed')->nullable();
            $table->enum('type', ['commercial', 'semi_commercial', 'residential'])->default(null);
            $table->enum('status', ['available', 'hold', 'sold'])->default(null);
            $table->string('price')->nullable();
            $table->longText('description')->nullable();
            $table->text('plot_feature')->nullable();
            $table->text('business_feature')->nullable();
            $table->text('community_feature')->nullable();
            $table->text('healthcare_feature')->nullable();
            $table->text('other_facilities')->nullable();
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
        Schema::dropIfExists('building_properties');
    }
}
