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
            'sections' => Section::with(array('products' => function ($products) {
                $products->orderBy('position');
            }))
                ->orderBy('position')
                ->get()
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
        //TODO Сделать валидацию (поля weight и price должны быть integer)

        Product::create($this->setpositionToRequest($request));

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
        //TODO Сделать валидацию (поля weight и price должны быть integer)
        ($request->status) ?? $request->merge(['status' => 0]);

        if($request->section_id == $product->section_id) {
            $product->update($request->all());
        } else {
            $product->update($this->setpositionToRequest($request));
            $product->incrementRowBySection();
        }

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Application|RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->deleteAndIncrement();
        return redirect(route('products.index'));
    }

    public function changeStatusAjax(Request $request)
    {
        $product = Product::find($request->id);

        return response()->json([
            'status' => $product->changeStatus()
        ]);
    }

    public function positionUp($position, $section)
    {
        if ((int)$position !== 1) {
            Product::swapping($position, $section);
        }
        return redirect(route('products.index'));
    }

    public function positionDown($position, $section)
    {
        if ((int)$position !== Product::whereSection_id($section)->max('position')) {
            Product::swapping($position + 1, $section);
        }
        return redirect(route('products.index'));
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function setPositionToRequest(Request $request): array
    {
        return $request->merge([
            'position' => Product::whereSection_id($request->section_id)
                    ->max('position') + 1
        ])->all();
    }
}
