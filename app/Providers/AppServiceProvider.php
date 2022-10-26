<?php

namespace App\Providers;

use App\Models\BuildingSaleHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Auth::check()){
            $meeting = BuildingSaleHistory::where('key','lead')->where('data->status', 'arrange_meeting')->whereDate('data->date','>=',Carbon::now())->orderBy('data->date','ASC')->first();
            view()->composer('*',function($view) use ($meeting) {
                $view->with('meeting_alert', $meeting);
            });
        }
    }
}
