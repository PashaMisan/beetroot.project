<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Метод выводит содержимое корзины.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        //Проверяется существование куки 'orders'.
        //Если существует - распаковывается, если нет - объявляется пустой массив;
        $orders = (Cookie::has('orders')) ? unserialize(Cookie::get('orders')) : [];

        //К каждой позиции в массиве подтсягивается объект продукта и цена с учетом количества.
        foreach ($orders as $product_id => $quantity) {
            $orders[$product_id]['product'] = Product::find($product_id);
            $orders[$product_id]['fullPrice'] = $orders[$product_id][0] * $orders[$product_id]['product']->price;
        }

        return view('cart', compact('orders'));
    }
}
