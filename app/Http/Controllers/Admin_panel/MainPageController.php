<?php

namespace App\Http\Controllers\Admin_panel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MainPageController extends Controller
{
    public function index()
    {
        return view('admin_panel.main_page', ['user'=> Auth::user()]);
    }
}
