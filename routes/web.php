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

Route::get('/', 'MainPageController@index')->name('main');
Route::get('/menu', 'MenuPageController@index')->name('menu');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Admin panel rout groups

//Dashboard

//All registered users have this ability
Route::get('admin-panel/', 'Admin_panel\MainPageController@index')->middleware('auth')->name('admin_panel_main');

//Abilities that can only have an administrator
Route::group([
    'middleware' => ['auth', 'admin'],
    'prefix' => 'admin-panel'
], function () {
    //Sections
    Route::resource('sections', 'Admin_panel\SectionsController')->except(['create', 'show']);
    Route::get('sections/{position}/position_up', 'Admin_panel\SectionsController@positionUp')->name('position_up');
    Route::get('sections/{position}/position_down', 'Admin_panel\SectionsController@positionDown')
        ->name('position_down');

    //Products
    Route::resource('products', 'Admin_panel\ProductsController');
    Route::get('product/{position}/position_up/{section}', 'Admin_panel\ProductsController@positionUp')
        ->name('p_position_up');
    Route::get('products/{position}/position_down/{section}', 'Admin_panel\ProductsController@positionDown')
        ->name('p_position_down');
    Route::post('product/change-status', 'Admin_panel\ProductsController@changeStatusAjax')
        ->name('change_product_status_ajax');
});


