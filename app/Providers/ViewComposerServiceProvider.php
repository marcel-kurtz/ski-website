<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Http\ViewComposer\menueComposer;
use Illuminate\Support\Facades\Log;

class ViewComposerServiceProvider extends ServiceProvider
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
        Log::info('ViewComposers called');

        View::composer(
            'layouts.includes.menue', menueComposer::class
        );

    }
}