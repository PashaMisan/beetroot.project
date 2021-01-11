<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Section;

class MenuPageController extends Controller
{
    public function index()
    {
        $menu = Section::with(['products' => function ($query) {
            $query->where('status', 1);
        }])
            ->orderBy('position')
            ->get();

        return view('menu', [
            'menu' => $menu->filter(function ($value) {
                return (!empty($value->products[0])) ? $value : false;
            })->values()
        ]);
    }
}
