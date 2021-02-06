<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    /**
     * Выводит Invoice на экран вместе с продуктами в статусе Accepted.
     *
     * @param Invoice $invoice
     * @return Application|Factory|Response|View
     */
    public function show(Invoice $invoice)
    {
        return view('admin_panel.invoice', [
            'products' => $invoice->order->productArr('Accepted'),
            'invoice' => $invoice
        ]);
    }
}
