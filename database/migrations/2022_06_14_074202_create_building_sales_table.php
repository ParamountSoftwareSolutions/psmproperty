<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->unsigned()->nullable()->constrained('buildings')->onDelete('cascade');
            $table->foreignId('floor_detail_id')->unsigned()->nullable()->constrained('floor_details')->onDelete('cascade');
            $table->foreignId('customer_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('user_id')->unsigned()->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('payment_plan_id')->unsigned()->nullable()->constrained('building_payment_plans')->onDelete('cascade');
            $table->string('registration_number')->nullable();
            $table->string('hidden_file_number')->nullable();
            $table->integer('down_payment')->nullable();
            $table->date('due_date')->nullable();
            $table->string('interested_in')->nullable();
            $table->string('source')->nullable();
            $table->enum('order_status', ['new', 'follow_up', 'discussion', 'negotiation', 'lost', 'pending', 'approved', 'rejected', 'arrange_meeting', 'meet_client',
                'mature', 'active', 'cancel', 'suspended','cancelled','transferred',]);
            $table->enum('order_type', ['lead', 'online_booking', 'sale']);
            $table->enum('priority', ['very_hot', 'hot', 'moderate','cold'])->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('building_sales');
    }
}
