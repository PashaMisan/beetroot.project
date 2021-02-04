<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Invoice;
use App\Admin_panel_models\Order;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoice = Invoice::with('order')->find(\request('id'));

        return view('admin_panel.invoice', compact('invoice'));
    }
}
