<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Order;
use App\Admin_panel_models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Class MenuPageController
 * @package App\Http\Controllers
 */
class MenuPageController extends Controller
{
    /**
     * Возвращает View для страницы меню.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // Берутся все секции с продуктами в статусе 1 (On)
        $menu = Section::with(['products' => function ($query) {
            $query->where('status', 1)
                ->orderBy('position');
        }])
            ->orderBy('position')
            ->get();

        // Если все продукты секции имеют статус 0 (Off), то эта секция пропускается
        return view('menu', [
            'menu' => $menu->filter(function ($value) {
                return (!empty($value->products[0])) ? $value : false;
            })->values()
        ]);
    }

    /**
     * AJAX метод по возможности переключает статус Order в Call, и отправляет пользователю соответствующее сообщение.
     *
     * @return JsonResponse
     */
    public  function waiterCallAjax()
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
