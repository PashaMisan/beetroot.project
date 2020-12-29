<?php

namespace App\Http\Controllers\Admin_panel;

use App\Section;
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
            'sections' => Section::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        //TODO Добавить валидацию реквеста
        $section = new Section();
        $section->name = $request->section_name;
        $section->save();
        return redirect(route('sections.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Section $section
     * @return void
     */
    public function show(Section $section)
    {
        //
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
            'sections' => Section::all(),
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
        //TODO Добавить валидацию реквеста
        $section->name = $request->edit_section_name;
        $section->save();
        return redirect(route('sections.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Section $section
     * @return Application|RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect(route('sections.index'));
    }
}
