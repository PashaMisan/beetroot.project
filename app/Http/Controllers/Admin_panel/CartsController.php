<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Cart;
use App\Admin_panel_models\Order;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $cartItems = Cart::whereOrder_id(request('id'))->with('product')->get();

        //Если заказ не содержит в себе продукты, то статус заказа меняется на Open.
        if(!count($cartItems)) {
            Order::statusManager(\request('id'), 1);
            return redirect(route('admin_panel_main'));
        }

        return view('admin_panel.table_cart', compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
