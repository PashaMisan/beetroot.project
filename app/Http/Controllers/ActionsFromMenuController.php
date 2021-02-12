<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Order;
use App\User;
use Illuminate\Http\Request;

class ActionsFromMenuController extends Controller
{
    public  function callWaiter()
    {
        //TODO Вернуть сообщение о том что официант сейчас подойдет
        //TODO Изменять статус заказа только в случае если он находится в статусе Open
        //TODO В случае если заказ не в статусе Open - вернуть сообщение что официант сейчас обрабатывает этот заказ
        //Чтобы сработал  Event::listen в EventServiceProvider нужно вызывать метод first()
        Order::where('key', request()->cookie('table_key'))->first()->update(['status_id' => 2]);;

        return redirect(route('menu'));
    }
}
