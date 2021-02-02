<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;
use Throwable;

/**
 * Class CartController
 * @package App\Http\Controllers
 */
class CartController extends Controller
{
    /**
     * Свойство содержит в себе корзину (массив вида [product_id => quantity])
     *
     * @var
     */
    private $cart = [];

    /**
     * CartController constructor.
     */
    public function __construct()
    {
        $this->setCart();
    }

    /**
     * Метод выводит содержимое корзины.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $orders = $this->pullUpProducts();

        return view('cart', [
            'orders' => $orders,
            'totalPrice' => array_sum(array_column($orders, 'fullPrice'))
        ]);
    }

    /**
     * Метод по Ajax запросу удаляет продукт из корзины пользователя.
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function removeFromCartAjax()
    {
        //Удаляем из корзины продукт по его id
        unset($this->cart[request('value')[0]]);

        //Сериализируем и устанавливаем cookie корзины
        Cookie::queue('orders', serialize($this->cart), 480);

        //Возваращаем ответ в виде обновленной html странички
        return response()->json([
            'html' => view('ajax.tables.cart')->with(['orders' => $this->pullUpProducts()])->render()
        ]);
    }

    /**
     * Метод по Ajax запросу принимает новое количество товара в корзине, и отвечает новой полной стоимости товара с
     * учетом его количества.
     *
     * @return JsonResponse
     */
    public function fullPriceAjax()
    {
        //Получаем значение id продукта и его новое количество
        list($product_id, $quantity) = request('value');

        //Устанавливаем новое количчество продукта, сериаилизируем его и устанавливаем в cookie
        $this->cart[$product_id] = (array) $quantity;
        Cookie::queue('orders', serialize($this->cart), 480);

        //Возвращаем ответ в виде цены на товар с учетом его количества
        return response()->json([
            'fullPrice' => Product::find($product_id)->price * $quantity,
            'totalPrice' => array_sum(array_column($this->pullUpProducts(), 'fullPrice'))
        ]);
    }

    /**
     * Если корзина ползователя в cookie не пустая, то метод предоставляет ее в виде массива
     *
     * @return void
     */
    private function setCart(): void
    {
        if (Cookie::has('orders')) $this->cart = Crypt::decrypt(Cookie::get('orders'), true);
    }

    /**
     * Метод берет корзину пользователя ($cart), и по каждому элементу подтягивает продукт и его полную стоимость
     * с учетом количества.
     *
     * @return array
     */
    private function pullUpProducts(): array
    {
        //К каждой позиции в массиве подтсягивается объект продукта и цена с учетом количества.
        $orders = &$this->cart;

        foreach ($orders as $product_id => $quantity) {
            $orders[$product_id]['product'] = Product::find($product_id);
            $orders[$product_id]['fullPrice'] = (integer)$orders[$product_id][0] * $orders[$product_id]['product']->price;
        }

        return $orders;
    }
}
