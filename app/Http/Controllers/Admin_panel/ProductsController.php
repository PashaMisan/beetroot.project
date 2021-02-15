<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Product;
use App\Admin_panel_models\Section;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Throwable;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('admin_panel.products', $this->getSectionsArr());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Application|Factory|Response|View
     */
    public function create(Request $request)
    {
        return view('admin_panel.products_new', [
            "section_id" => request('section_id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProduct $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreProduct $request)
    {
        Product::create($this->setpositionToRequest($request))
            ->update(['image' => $request->image->store('uploads', 'public')]);

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
     * @param UpdateProduct $request
     * @param Product $product
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(UpdateProduct $request, Product $product)
    {
        // Если инпут name="status" был пустым, значит необходимо указать что статус продука равен нулю
        ($request->status) ?? $request->merge(['status' => 0]);

        if ($request->section_id == $product->section_id) {
            $product->update($request->all());
        } else {
            $product->update($this->setpositionToRequest($request));
            $product->incrementRowBySection();
        }

        if ($request->has('image')) $product->update(['image' => $request->image->store('uploads', 'public')]);

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
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

    /**
     * Метод принимает Post запрос с данными о текщей позиции продукта, секции, и значением шага.
     *
     * Значение шага имеет логический тип данных:
     * true - продукт необходимо переместить на шаг выше;
     * false - продукт необходимо переместить на шаг ниже.
     * Помимо проверки на значение шага, выполняется проверка на его крайность. Последний продукт невозможно перенести
     * еще ниже, а самый первый продукт - выше.
     *
     * Метод возвращает json в котором содержится обновленный html таблицы продуктов.
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function changePosition()
    {
        list($position, $section, $move) = request('value');

        if ($move && (int)$position !== 1) {
            Product::swapping($position, $section);
        } elseif (!$move && (int)$position !== Product::whereSection_id($section)->max('position')) {
            Product::swapping($position + 1, $section);
        }

        return response()->json([
            'html' => view('admin_panel.ajax.productTable', $this->getSectionsArr())->render()
        ]);
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

    /**
     * Возвращает массив в котором по ключу 'sections' содержится коллекция секций отсортированных по позиции вместе с
     * продуктами.
     *
     * @return array
     */
    private function getSectionsArr(): array
    {
        return [
            'sections' => Section::with(array('products' => function ($products) {
                $products->orderBy('position');
            }))->orderBy('position')
                ->get()
        ];
    }


}
