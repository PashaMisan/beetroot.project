<?php

namespace App\Http\Controllers\Admin_panel;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Throwable;

/**
 * Class MainPageController
 * @package App\Http\Controllers\Admin_panel
 */
class MainPageController extends Controller
{
    /**
     * Метод собирает все необходимые данные для отображения главной страница админ панели.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin_panel.main_page', array_merge(

            //Данные для основных виджетов
            GeneralDashboardController::dashboard(),

            //Данные для виджета официанта (только для официантов)
            (Auth::user()->isWaiter()) ? WaiterDashboardController::waiterDashboard() : []
            ));
    }

    /**
     * Метод который отвечает на Ajax запрос с главной страницы панели администратора.
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function answerAjax()
    {
        $last_change_of_orders = Cache::get('last_change_of_orders');

        //Массив с данными, которые будут всегда присутствовать в ajax ответе.
        $staticData = [
            'request' => request()->all(),
            'waiters_status_table' => GeneralDashboardController::waitersStatusTableRender(),
            'last_change_of_orders' => $last_change_of_orders
        ];

        //Массив который будет динамически дополнять данными $staticData.
        $dynamicData = [];

        //Если даты последних обновлений таблицы orders разные - к ответу добавляется новая таблица Table status.
        if ($last_change_of_orders !== request()->input('value')) {
            $dynamicData['tables_status'] = GeneralDashboardController::tablesStatusRender();
            (Auth::user()->isWaiter()) ? $dynamicData['my_tables'] = WaiterDashboardController::myTablesRender() : false;
        }

        return response()->json(array_merge($staticData, $dynamicData));
    }
}
