<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Admin panel rout groups
Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin-panel'
], function() {
    Route::get('/', 'Admin_panel\MainPageController@index')->name('admin_panel_main');
    Route::resource('sections', 'Admin_panel\SectionsController')->except([
        'create', 'show'
    ]);
});
