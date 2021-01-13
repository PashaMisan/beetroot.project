<?php

namespace App\Http\Controllers\Admin_panel;

use App\Admin_panel_models\Section;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin_panel.sections', [
            'user' => Auth::user(),
            'sections' => Section::orderBy('position')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        Section::create($request->merge([
            'position' => Section::max('position') + 1
        ])->all());

        return redirect(route('sections.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Section $section
     * @return Application|Factory|View
     */
    public function edit(Section $section)
    {
        return view('admin_panel.section_edit', [
            'user' => Auth::user(),
            'sections' => Section::all()->sortBy('position'),
            'section' => $section]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Section $section
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, Section $section)
    {
        $section->update($request->all('name'));

        return redirect(route('sections.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Section $section
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Section $section)
    {
        $section->delete();
        Section::incrementPositions();
        return redirect(route('sections.index'));
    }

    public function positionUp($position)
    {
        if ((int)$position !== 1) {
            Section::swapping($position);
        }
        return redirect(route('sections.index'));
    }

    public function positionDown($position)
    {
        if ((int)$position !== Section::max('position')) {
            Section::swapping($position + 1);
        }
        return redirect(route('sections.index'));
    }
}
