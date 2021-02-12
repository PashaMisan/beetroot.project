<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

/**
 * Class ProductSingleController
 * @package App\Http\Controllers
 */
class ProductSingleController extends Controller
{
    /**
     * Отображает карточку блюда с возможностью выбора количества.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function index(Product $product)
    {
        $products = Product::randomProducts($product->section_id, 4);

        return view('productSingle', compact('product', 'products'));
    }

    /**
     * Метод принимает request параметры, и зписывает их в cookie пользователя;
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function addToCart(Request $request)
    {
        //Массив $request будет содержать следующую структуру ["quantity" => int, "product_id" => int];
         $request = $request->validate([
             'quantity' => 'required|min:0|numeric|not_in:0',
             'product_id' => 'required|min:0|numeric|not_in:0|exists:products,id',
        ]);

        //Проверяется существование куки 'orders'.
        //Если существует - распаковывается, если нет - объявляется пустой массив;
        $orders = (Cookie::has('orders')) ? unserialize(Cookie::get('orders')) : [];

        //В массив по ключу product_id записывается значение количества;
        $orders[$request['product_id']] = (array) $request['quantity'];

        Cookie::queue('orders', serialize($orders), 480);

        return redirect(route('cart'));
    }
}
