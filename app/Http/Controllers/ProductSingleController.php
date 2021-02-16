<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Product;
use App\Services\OrdersInCookieService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class ProductSingleController
 * @package App\Http\Controllers
 */
class ProductSingleController extends Controller
{
    /**
     * Отображает карточку блюда.
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
     * @param OrdersInCookieService $ordersInCookieService
     * @return Application|RedirectResponse|Redirector
     */
    public function addToCart(Request $request, OrdersInCookieService $ordersInCookieService)
    {
        // Массив $request будет содержать следующую структуру ["quantity" => int, "product_id" => int];
         $request = $request->validate([
             'quantity' => 'required|min:0|numeric|not_in:0',
             'product_id' => 'required|min:0|numeric|not_in:0|exists:products,id',
        ]);

         // Добавляет в корзину новый продукт и его количество
         $ordersInCookieService->addToCart($request);

        return redirect(route('cart'));
    }
}
