<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Cart;
use App\Admin_panel_models\Order;
use App\Admin_panel_models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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
            'totalPrice' => array_sum(array_column($orders, 'fullPrice')),
            //TODO Добавить надпись на случай если история пустая
            'cartStory' => $this->cartStory()
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
        $this->cart[$product_id] = (array)$quantity;
        Cookie::queue('orders', serialize($this->cart), 480);

        //Возвращаем ответ в виде цены на товар с учетом его количества
        return response()->json([
            'fullPrice' => Product::find($product_id)->price * $quantity,
            'totalPrice' => array_sum(array_column($this->pullUpProducts(), 'fullPrice'))
        ]);
    }


    /**
     * При вызове метода, продукты из корзины в куках пользователя переносятся в БД.
     *
     * При записи в БД заказ закрепленный за столиком меняет свой статус для отображения официанту.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function confirmOrder()
    {
        //Проверка корзины на пустоту
        if (!$this->cart) return redirect(route('cart'));

        //В БД находится заказ закрепленный за столиком
        $order = Order::where('key', request()->cookie('table_key'))->first();

        //Для каждого продукта из корзины в куках создается отдельная позиция в таблице 'carts'
        foreach ($this->cart as $key => $item) {
            Cart::create([
                'order_id' => $order->id,
                'product_id' => $key,
                'quantity' => $item[0],
                'condition_id' => 1
            ]);
        }

        //Заказу присваевается новый статус
        $order->status_id = 3;
        $order->save();

        Cookie::queue('orders', serialize([]), 1);

        return redirect(route('cart'));
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

    /**
     * Метод собирает все заказанные продукты, а также их итоговую стоимость.
     *
     * @return array
     */
    private function cartStory(): array
    {
        $order = Order::where('key', request()->cookie('table_key'))->first();
        $productArr = $order->productArr();

        usort($productArr, function($a, $b){
            return ($b['created_at'] - $a['created_at']);
        });

        $sum = $order->invoice->getArray_sum($productArr);

        return compact('productArr', 'sum');
    }
}
