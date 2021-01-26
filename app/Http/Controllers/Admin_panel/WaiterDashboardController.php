<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Order;
use App\Admin_panel_models\Table;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Throwable;

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

    static function myTablesRender()
    {
        return view('admin_panel.dashboards.ajax.waiterMyTables')
            ->with(self::waiterDashboard())->render();
    }

    public function openTable(Request $request)
    {
        $key = Str::random(5);

        Order::create($request->merge([
            'user_id' => Auth::id(),
            'status_id' => 1,
            'key' => $key,
        ])->all());

        return redirect(route('admin_panel_main'));
    }

    public function closeTable($id)
    {
        //Чтобы сработал  Event::listen в EventServiceProvider нужно вызывать метод first()
        Order::whereTable_id($id)->first()->delete();

        return redirect(route('admin_panel_main'));
    }
}
