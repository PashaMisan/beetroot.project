<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Order;
use App\Admin_panel_models\Table;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaiterDashboardController extends Controller
{
    static function waiterDashboard()
    {
        return $data[] = [
            'waiterTables' => Table::with('order')
                ->whereHas('order', function ($user) {
                    return $user->whereUser_id(Auth::id());
                })->get(),
            'freeTables' => Table::with('order')->doesntHave('order')->get()
        ];
    }

    public function openTable(Request $request)
    {
        Order::create($request->merge([
            'user_id' => Auth::id(),
            'key' => 'test',
            'qr' => 'test'
        ])->all());

        return redirect(route('admin_panel_main'));
    }

    public function closeTable($id)
    {
        Order::whereTable_id($id)->delete();
        return redirect(route('admin_panel_main'));
    }
}
