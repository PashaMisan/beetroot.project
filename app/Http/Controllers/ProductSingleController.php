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
        // Выбирает 4 рандомных продукта из секции выбраного продукта.
        $products = Product::whereSection_id($product->section_id)->whereStatus(1)->inRandomOrder()->take(4)->get();

        return view('productSingle', compact('product', 'products'));
    }

    /**
     * Метод принимает request параметры, и зписывает их в cookie пользователя;
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function addToCart()
    {
        //TODO Добавить проверку на quantity. Должно быть только int

        //Массив ниже содержит следующую структуру ["quantity" => int, "product_id" => int];
        $request = request()->except('_token');

        //Проверяется существование куки 'orders'.
        //Если существует - распаковывается, если нет - объявляется пустой массив;
        $orders = (Cookie::has('orders')) ? unserialize(Cookie::get('orders')) : [];

        //В массив по ключу product_id записывается значение количества;
        $orders[$request['product_id']] = (array) $request['quantity'];

        Cookie::queue('orders', serialize($orders), 480);

        return redirect(route('cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return void
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return void
     */
    public function destroy(Product $product)
    {
        //
    }
}
