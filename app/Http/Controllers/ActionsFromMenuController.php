<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Order;
use App\User;
use Illuminate\Http\Request;

class ActionsFromMenuController extends Controller
{
    public  function callWaiter()
    {
        //TODO добавить проверку на наличие table_key куки
        //Чтобы сработал  Event::listen в EventServiceProvider нужно вызывать метод first()
        Order::where('key', request()->cookie('table_key'))->first()->update(['status_id' => 2]);;

        return redirect(route('menu'));
    }
}
