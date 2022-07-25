<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;
use Auth;
use App\Models\Link;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('*', function ($view) {
            $params = $query->Query();
            if (Auth::check()) {
                $params['customer'] = Auth::user();
            }
            $view->with($params);
        });

    }
}
