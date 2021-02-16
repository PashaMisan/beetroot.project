<?php

namespace App\Http\Controllers\Admin_panel;

use App\Http\Requests\StaffCreateStore;
use App\Role;
use App\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin_panel.staff', [
            'users' => User::with('roles')->get(),
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StaffCreateStore $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StaffCreateStore $request)
    {
        User::create($request->all())->assignRole(Role::find($request->role));
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'));
    }
}
