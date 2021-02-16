<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Table;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Cache;
use Throwable;

/**
 * Class GeneralDashboardController
 * @package App\Http\Controllers\Admin_panel
 */
class GeneralDashboardController extends Controller
{
    /**
     * Метод собирает в массив всю необходимую информацию для основной панели администратора.
     *
     * @return array
     */
    static function dashboard()
    {
        return $data[] = [
            'tables' => Table::with('order')->get(),
            'waiters' => User::whereHas('roles', function ($role) {
                return $role->whereName('waiter');
            })->get(),
            'last_change_of_orders' => json_encode(Cache::get('last_change_of_orders'))
        ];
    }

    /**
     * Метод возвращает актуальный HTML таблицы виджета Waiters status
     *
     * @return array|string
     * @throws Throwable
     */
    static function waitersStatusTableRender()
    {
        return view('admin_panel.dashboards.ajax.generalWaitersStatusTable')
            ->with(self::dashboard())
            ->render();
    }

    /**
     * Метод возвращает актуальный HTML таблицы виджета Tables status
     *
     * @return array|string
     * @throws Throwable
     */
    static function tablesStatusRender()
    {
        return view('admin_panel.dashboards.ajax.generalTablesStatus')
            ->with(self::dashboard())->render();
    }
}

