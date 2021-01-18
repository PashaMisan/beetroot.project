<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Table;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class MainPageController extends Controller
{
    public function index()
    {
        return view('admin_panel.main_page', array_merge(
            GeneralDashboardController::generalDashboard(),
            (Auth::user()->isWaiter()) ? WaiterDashboardController::waiterDashboard() : []
            ));
    }

}
