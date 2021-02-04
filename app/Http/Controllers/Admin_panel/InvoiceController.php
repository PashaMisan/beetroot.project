<?php

namespace App\Http\Controllers\Admin_panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('admin_panel.invoice');
    }
}
