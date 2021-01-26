<?php

namespace App\Providers;

use App\Admin_panel_models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //Событие срабатывает только при вытягивании обьекта из БД, к примеру при использовании метода first();
        //https://github.com/laravel/framework/issues/2536
        Event::listen([
            'eloquent.deleted: App\Admin_panel_models\Order',
            'eloquent.saved: App\Admin_panel_models\Order'
            ],
            function () {
                Cache::forever('last_change_of_orders', Carbon::now()->toDateTimeString());
            });
    }
}
