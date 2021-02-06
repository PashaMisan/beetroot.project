<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Cart;
use App\Admin_panel_models\Order;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $order = Order::find(request('id'));
        $cartItems = $order->productArr('Sent');

        if (!$cartItems) {
            return $this->orderStatusUpdate($order);
        }

        return view('admin_panel.table_cart', [
            'cartItems' => $cartItems,
            'orderId' => $order->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cart $cart
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect(route('carts.index', ['id' => $cart->order_id]));
    }

    /**
     * Переводит все продукты заказа в статус Accepted и записывает актуальную сумму заказа в чек.
     *
     * @param Order $order
     * @return Application|RedirectResponse|Redirector
     */
    public function acceptCarts(Order $order)
    {
        //Обновление статусов Cart
        foreach ($order->carts as $item) {
            $item->update(['condition_id' => 2]);
        }

        //Обновление итоговой суммы чека.
        $order->invoice->sumUpdate();

        return $this->orderStatusUpdate($order);
    }

    /**
     * Метод обновляет статус заказа и перенаправляет на страницу понели администратора.
     *
     * @param Order $order
     * @return Application|RedirectResponse|Redirector
     */
    private function orderStatusUpdate(Order $order)
    {
        //Обновление статуса заказа.
        $order->update(['status_id' => 1]);

        return redirect(route('admin_panel_main'));
    }
}
