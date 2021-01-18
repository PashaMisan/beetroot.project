<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Table;
use App\Http\Controllers\Controller;
use App\User;

class GeneralDashboardController extends Controller
{
    static function generalDashboard()
    {
        return $data[] = [
            'tables' => Table::with('order')->get(),
            'waiters' => User::whereHas('roles', function ($role) {
                return $role->whereName('waiter');
            })->get()
        ];
    }
}
