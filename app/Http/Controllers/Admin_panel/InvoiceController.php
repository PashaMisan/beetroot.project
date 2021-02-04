<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    /**
     * Содержит в себе данные таблицы invoice.
     *
     * @var array
     */
    private $invoice = [];

    /**
     * В свойстве хранятся массивы с заказанными продуктами.
     *
     * @var array
     */
    private $products = [];

    /**
     * Сумма чека.
     *
     * @var
     */
    private $total = 0;

    /**
     * InvoiceController constructor.
     */
    public function __construct()
    {
        $this->setProducts(Order::with(['cart.product', 'cart.condition', 'invoice'])->find(request('id')));
        $this->setTotal();
    }

    /**
     * Выводит сформированный чек.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('admin_panel.invoice', [
            'products' => $this->products,
            'invoice' => $this->invoice
        ]);
    }

    /**
     * Устанавливает свойство $total
     *
     */
    private function setTotal(): void
    {
        $this->total = $this->getArray_sum($this->products);
    }

    /**
     * Заполняет свойство $products массивом продуктов.
     *
     * @param Order $order
     */
    private function setProducts(Order $order): void
    {
        foreach ($order->cart as $product) {
            $this->products[] = [
                'name' => $product->product->name,
                'price' => $product->product->price,
                'quantity' => $product->quantity,
                'fullPrice' => $product->product->price * $product->quantity,
                'condition' => $product->condition->name
            ];
        }

        $this->setInvoice($order);
    }

    /**
     * Устанавливает свойство Invoice.
     *
     * @param Order $order
     */
    private function setInvoice(Order $order): void
    {
        $this->invoice = $order->invoice->toArray();

        $this->invoice['sum'] = $this->getArray_sum(array_filter($this->products, function ($value) {
            if ($value['condition'] == 'Accepted') return $value;
        }));
    }

    /**
     * Получает итоговую сумму по продуктам из переданного массива.
     *
     * @param array $arr
     * @return float|int
     */
    private function getArray_sum(array $arr): int
    {
        return array_sum(array_column($arr, 'fullPrice'));
    }
}
