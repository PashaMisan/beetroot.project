<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Section;

class MenuPageController extends Controller
{
    public function index()
    {
        return view('menu', [
            'menu' => Section::with(['products' => function ($query) {
                $query->where('status', 1);
            }])->get()
        ]);
    }
}
