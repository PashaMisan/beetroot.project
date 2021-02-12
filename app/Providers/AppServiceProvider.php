<?php

namespace App\Providers;

use App\Admin_panel_models\Order;
use App\Admin_panel_models\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

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
        Blade::if('AdminAccess', function () {
            return Auth::user()->isAdmin();
        });

        Blade::if('ForWaiter', function () {
            return Auth::user()->isWaiter();
        });

        Blade::if('HasKey', function () {
            return Order::hasKey();
        });

        Blade::if('HasNotKey', function () {
            return !Order::hasKey();
        });

        Blade::if('OrderNotInPaymentRequestStatus', function () {
            return !Order::where('key', Cookie::get('table_key'))->first()->onPaymentRequest();
        });

    }
}
