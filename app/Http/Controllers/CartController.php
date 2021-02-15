<?php

namespace App\Http\Controllers;

use App\Admin_panel_models\Cart;
use App\Admin_panel_models\Order;
use App\Admin_panel_models\Product;
use App\Services\OrdersInCookieService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;
use Throwable;

/**
 * Class CartController
 * @package App\Http\Controllers
 */
class CartController extends Controller
{
    /**
     * Метод выводит содержимое корзины.
     *
     * @param OrdersInCookieService $service
     * @return Application|Factory|View
     */
    public function index(OrdersInCookieService $service)
    {
        return view('cart', [
            'orders' => $service->getOrdersWithProduct(),
            'totalPrice' => $service->totalPrice(),
            'cartStory' => $this->cartStory(),
            'products' => Product::randomProducts(array_rand(array_flip(array_unique(Product::whereStatus(1)
                ->pluck('section_id')
                ->toArray()))))
        ]);
    }

    /**
     * Метод по Ajax запросу удаляет продукт из корзины пользователя.
     *
     * @param OrdersInCookieService $service
     * @return JsonResponse
     * @throws Throwable
     */
    public function removeFromCartAjax(OrdersInCookieService $service)
    {
        $service->unsetProduct(request('value')[0]);

        //Возваращаем ответ в виде обновленной html странички
        return response()->json([
            'html' => view('ajax.tables.cart')->with(['orders' => $service->getOrdersWithProduct()])->render(),
            'totalPrice' => $service->totalPrice(),
            'status' => 200
        ]);
    }

    /**
     * Метод по Ajax запросу принимает новое количество товара в корзине, и отвечает новой полной стоимости товара с
     * учетом его количества.
     *
     * @param OrdersInCookieService $service
     * @return JsonResponse
     */
    public function fullPriceAjax(OrdersInCookieService $service)
    {
        //Получаем значение id продукта и его новое количество
        list($product_id, $quantity) = request('value');

        //Валидируем введенное количество, если оно не прошло валидацию - возвращаем 400 статус
        if (!is_numeric($quantity) || !$quantity) return response()->json(['status' => 400]);
        $quantity = abs((integer)$quantity);

        // Устанавливается новое количество продукта
        $service->changeQuantity($product_id, $quantity);

        //Возвращаем ответ в виде цены на товар с учетом его количества
        return response()->json([
            'fullPrice' => Product::find($product_id)->price * $quantity,
            'totalPrice' => $service->totalPrice(),
            'status' => 200
        ]);
    }

    /**
     * При вызове метода, продукты из корзины в куках пользователя переносятся в БД.
     *
     * При записи в БД заказ закрепленный за столиком меняет свой статус для отображения официанту.
     *
     * @param OrdersInCookieService $service
     * @return Application|RedirectResponse|Redirector
     */
    public function confirmOrder(OrdersInCookieService $service)
    {
        //Проверка корзины на пустоту
        if (!$service->orders) return redirect(route('cart'));

        //В БД находится заказ закрепленный за столиком
        $order = Order::getOrderByCookiesKey();

        //Для каждого продукта из корзины в куках создается отдельная позиция в таблице 'carts'
        foreach ($service->orders as $key => $item) {
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
     * Метод меняет статус Order на Payment request.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function payTheBill()
    {
        // Получаем Order по ключу столика в куках пользователя
        $order = Order::getOrderByCookiesKey();

        // Проверяем, есть ли у всех Cart, которые пренадлежат Order, состояние Accepted
        if ($order->isAllCartsAccepted()) {

            // Если у всех есть - меняем статус Order на Payment request
            $order->update(['status_id' => 4]);
            $message = 'Payment request received, please wait for a waiter.';

        } else {

            // Если не у всех - стату остается прежним
            $message = 'Some of your orders are pending, please try again later.';

        }

        // В любом случае пользователю выводится соответствующее сообщение
        return redirect(route('cart'))->with(compact('message'));
    }

    /**
     * Метод собирает все заказанные продукты, а также их итоговую стоимость.
     *
     * @return array
     */
    private function cartStory(): array
    {
        $order = Order::getOrderByCookiesKey();
        $productArr = $order->productArr();

        usort($productArr, function ($a, $b) {
            return ($b['created_at'] - $a['created_at']);
        });

        $sum = $order->invoice->getArray_sum($productArr);

        return compact('productArr', 'sum');
    }
}
