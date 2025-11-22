<?php

namespace App\Providers;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Carbon::setLocale(app()->getLocale()); // or manually: 'ar' or 'en'
        setlocale(LC_TIME, app()->getLocale() == 'ar' ? 'ar_AR.utf8' : 'en_US.utf8');
        Paginator::useBootstrap();
    }
}
