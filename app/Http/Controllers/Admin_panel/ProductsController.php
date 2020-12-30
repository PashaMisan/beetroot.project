<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Product;
use App\Admin_panel_models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('admin_panel.products', [
            'user' => Auth::user(),
            'sections' => Section::with('products')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create(Request $request)
    {
        return view('admin_panel.products_new', [
            'user' => Auth::user(),
            'section_id' => $request->section_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        //TODO Добавить валидацию Request
        $product = new Product();
        $product->name = $request->product_name;
        $product->section_id = $request->section_id;
        $product->description = $request->product_description;
        $product->weight = $request->product_weight;
        $product->price = $request->product_price;
        $product->status = ((isset($request->status)) ? 1 : 0);
        $product->save();

        return redirect(route('products.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|Response|View
     */
    public function show(Product $product)
    {
        return view('admin_panel.products_show', [
            'user' => Auth::user(),
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|Response|View
     */
    public function edit(Product $product)
    {
        return view('admin_panel.products_edit', [
        'user' => Auth::user(),
        'product' => $product,
        'sections' => Section::all(),
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Product $product)
    {
        //TODO Добавить валидацию Request;
        $product->name = $request->product_name;
        $product->section_id = $request->section_id;
        $product->description = $request->product_description;
        $product->weight = $request->product_weight;
        $product->price = $request->product_price;
        $product->status = ((isset($request->status)) ? 1 : 0);
        $product->save();

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('products.index'));
    }


    /**
     * @param Request $id
     * @return Application|RedirectResponse|Redirector
     */
    public function changeStatus($id)
    {
        $product = Product::find($id);

        if($product->status === 0){
            $product->status = 1;
        } else {
            $product->status = 0;
        }

        $product->save();
        return redirect(route('products.index'));
    }
}