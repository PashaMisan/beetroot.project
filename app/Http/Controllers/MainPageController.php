<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Section;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index()
    {
        return view('main');
    }
}
