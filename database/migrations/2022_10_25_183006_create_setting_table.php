<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('storename')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('logo')->nullable();
            $table->string('logoweb')->nullable();
            $table->string('favicon')->nullable();
            $table->string('opentime')->nullable();
            $table->string('closetime')->nullable();
            $table->string('vat')->nullable();
            $table->integer('isvatnumshow')->nullable();
            $table->string('vattinno')->nullable();
            $table->integer('discount_type')->nullable();
            $table->decimal('discountrate', 19,3)->nullable();
            $table->decimal('servicecharge', 10,0)->nullable();
            $table->integer('service_chargeType')->nullable();
            $table->integer('currency')->nullable();
            $table->string('min_prepare_time')->nullable();
            $table->string('language')->nullable();
            $table->string('timezone')->nullable();
            $table->string('dateformat')->nullable();
            $table->string('site_align')->nullable();
            $table->string('powerbytxt')->nullable();
            $table->string('footer_text')->nullable();
            $table->string('reservation_open')->nullable();
            $table->string('reservation_close')->nullable();
            $table->integer('maxreserveperson')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting');
    }
}
