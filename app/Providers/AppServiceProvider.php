<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;


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
    public function boot(): void
{
    View::composer('*', function ($view) {

        $nbNotifications = 0;

        if (Auth::check()) {
            $nbNotifications = Notification::where('users_id', Auth::id())
                ->where('lu', false)
                ->count();
        }

        $view->with('nbNotifications', $nbNotifications);
    });
}
}
