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
Route::get('/setKey', 'Admin_panel\TableKeyController@setKey')->name('set_key');

//TODO добавить проверку на наличие ключа заказа в куках пользователя
Route::get('/call_waiter', 'ActionsFromMenuController@callWaiter')->name('waiter_call');
//Admin panel rout groups

//Dashboard

//All registered users have this ability
Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin-panel'
], function () {
    Route::get('', 'Admin_panel\MainPageController@index')->name('admin_panel_main');
    Route::post('openTable', 'Admin_panel\WaiterDashboardController@openTable')->name('open_table');
    Route::get('{id}/closeTable', 'Admin_panel\WaiterDashboardController@closeTable')->name('close_table');

    //Обрабатывает Ajax запрос с главной странички админ панели
    Route::post('/mainPageAjax', 'Admin_panel\MainPageController@answerAjax')
        ->name('main_page_ajax');
});

//Abilities that can only have an administrator
Route::group([
    'middleware' => ['auth', 'admin'],
    'prefix' => 'admin-panel'
], function () {
    //MenuCreator->Sections
    Route::resource('sections', 'Admin_panel\SectionsController')->except(['create', 'show']);
    Route::get('sections/{position}/position_up', 'Admin_panel\SectionsController@positionUp')->name('position_up');
    Route::get('sections/{position}/position_down', 'Admin_panel\SectionsController@positionDown')
        ->name('position_down');

    //MenuCreator->Products
    Route::resource('products', 'Admin_panel\ProductsController');
    Route::get('product/{position}/position_up/{section}', 'Admin_panel\ProductsController@positionUp')
        ->name('p_position_up');
    Route::get('products/{position}/position_down/{section}', 'Admin_panel\ProductsController@positionDown')
        ->name('p_position_down');
    Route::post('product/change-status', 'Admin_panel\ProductsController@changeStatusAjax')
        ->name('change_product_status_ajax');

    //Staff->Manage
    Route::resource('users', 'Admin_panel\StaffController')->only(['index', 'store', 'destroy']);

    //Tables->Manage
    Route::resource('tables', 'Admin_panel\TablesController');
});


