<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Order;
use Illuminate\Http\JsonResponse;

/**
 * Class ActionsFromMenuController
 *
 * Класс отвечает на запросы пользователя со страницы Меню.
 *
 * @package App\Http\Controllers
 */
class ActionsFromMenuController extends Controller
{
    /**
     * AJAX метод по возможности переключает статус Order в Call, и отправляет пользователю соответствующее сообщение.
     *
     * @return JsonResponse
     */
    public  function callWaiterAjax()
    {
        //Получаем Order по ключу в cookies.
        $order = Order::getOrderByCookiesKey();

        /* Если Order в статусе Open, то меняем его статус на Call. В любом случаем передаем соответствующее сообщение
        пользователю */
        if ($order->status_id === 1) {
            $order->update(['status_id' => 2]);
            $message = 'Your request has been accepted! Please wait for the waiter.';
        } else {
            $message = 'Your previous request is still being processed, please wait.';
        }

        return response()->json(compact('message'));
    }
}
