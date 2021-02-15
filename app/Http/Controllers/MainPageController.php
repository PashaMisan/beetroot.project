<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Product;
use App\Admin_panel_models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class MainPageController
 * @package App\Http\Controllers
 */
class MainPageController extends Controller
{
    /**
     * Возвращает View главной страницы сайта.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // Собирает id всех секций
        $sections = Section::all()->pluck('id')->flip()->all();

        // создает массив продуктов, в кождом вложенном массиве - четыре рандомных продукта
        for($products = [], $i = 0; $i < 2; $i++ ) {
            $products[] = Product::randomProducts(array_rand($sections));
        }

        return view('main')->with(compact('products'));
    }
}
