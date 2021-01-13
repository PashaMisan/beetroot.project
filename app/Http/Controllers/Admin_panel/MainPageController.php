<?php

namespace App\Http\Controllers\Admin_panel;

use App\Ability;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;

class MainPageController extends Controller
{
    public function index()
    {
        /*$user = User::with('roles')->find(1);
        $moderator = Role::firstOrCreate([
            'name' => 'moderator'
        ]);

        $editForum = Ability::firstOrCreate([
            'name' => 'edit_forum'
        ]);

        $user->assignRole($moderator);

        $moderator->allowTo($editForum);

        dd($user->abilities());*/

        return view('admin_panel.main_page', ['user'=> Auth::user()]);
    }

}
