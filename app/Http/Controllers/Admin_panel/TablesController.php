<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Table;
use App\Http\Requests\StoreTable;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin_panel.tables', [
            'tables' => Table::all()->sortBy('number')->values()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTable $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreTable $request)
    {
        Table::create($request->all());
        return redirect(route('tables.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Table $table
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Table $table)
    {
        $table->delete();
        return redirect(route('tables.index'));
    }
}
