<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Invoice;
use App\Admin_panel_models\Order;
use App\Admin_panel_models\Table;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Throwable;

/**
 * Class WaiterDashboardController
 * @package App\Http\Controllers\Admin_panel
 */
class WaiterDashboardController extends Controller
{
    /**
     * Метод собирает открытые столики текущего официанта, а также собирает свободные столики.
     *
     * @return array
     */
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

    /**
     * Метод возвращает сформированное отображение таблицы для виджета официанта.
     *
     * @return array|string
     * @throws Throwable
     */
    static function myTablesRender()
    {
        return view('admin_panel.dashboards.ajax.waiterMyTables')
            ->with(self::waiterDashboard())->render();
    }

    /**
     * Метод создает заказ к которому привязывается официант и столик. Также заказ имеет уникальный ключ, по которому
     * можно идентифицировать заказ.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function openTable(Request $request)
    {
        $invoice = new Invoice();
        $invoice->save();

        Order::create($request->merge([
            'user_id' => Auth::id(),
            'status_id' => 1,
            'invoice_id' => $invoice->id,
            'key' => Str::random(5),
        ])->all());

        return redirect(route('admin_panel_main'));
    }

    /**
     * Метод закрывает заказ активного столика.
     *
     * @param Invoice $invoice
     * @return Application|RedirectResponse|Redirector
     */
    public function closeTable(Invoice $invoice)
    {
        $invoice->order->delete();

        return redirect(route('admin_panel_main'));
    }

    /**
     * Метод находит заказ к котораму привязан столик, и изменяет статус заказа на Open
     *
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function acceptTable($id)
    {
        Order::whereTable_id($id)->first()->update(['status_id' => 1]);

        return redirect(route('admin_panel_main'));
    }
}
