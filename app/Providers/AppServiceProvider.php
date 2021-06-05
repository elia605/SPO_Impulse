<?php

namespace App\Providers;

use App\Models\Action;
use App\Models\Member;
use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            view()->composer('*', function($view)
            {
                if (!Auth::guest()) {
                    if (Auth::user()->isAdmin() || Auth::user()->isOrg()) {
                        $reqs = Member::where('status', 'unread')->count() + Action::where('status', 'unread')->count();
                        $view->with('reqs', $reqs);
                    }
                }
            });
    }
}
