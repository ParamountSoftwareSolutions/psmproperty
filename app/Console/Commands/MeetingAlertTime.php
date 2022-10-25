<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BuildingSaleHistory;
use Carbon\Carbon;

class MeetingAlertTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meeting:alert';

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
        $meeting = BuildingSaleHistory::where('key','lead')->where('data->status', 'arrange_meeting')->where('data->is_read', 0)->whereDate('data->date',Carbon::now())->whereTime('data->date', '>=', Carbon::now())->orderBy('data->date','ASC')->first();

        return config('meeting.data', '1323');
        // $meeting = $meeting ? $meeting : '';
        // if($meeting){
        //     $time = json_decode($meeting->data)->date;
        //     $time = Carbon::parse($time)->format('h:i A');
        // }else{
        //     $time = '';
        // }

    }
}
