<?php

namespace App\Console\Commands;

use App\Helpers\NotificationHelper;
use App\Models\BuildingCustomer;
use App\Models\BuildingSale;
use App\Models\BuildingSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InstallmentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'installment:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sale = BuildingSale::with('customer', 'building_installment_single')->where(['order_status' => 'mature', 'order_type' => 'sale'])->whereDate('due_date', '>', Carbon::now());
        $customer_id = $sale->get()->pluck('customer_id')->toArray();
        $customer = User::whereIn('id', $customer_id)->get();
        foreach($customer as $data){
            (new NotificationHelper)->send_notification_single_user('installment_reminder', $data->customer);
        }
        return 1;
    }
}
