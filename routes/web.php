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

// Роуты авторизации
Auth::routes();

// Общедоступные роуты
Route::get('/', 'MainPageController@index')->name('main');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/menu', 'MenuPageController@index')->name('menu');
Route::get('/productSingle/{product}', 'ProductSingleController@index')->name('product_single');
Route::get('/setKey', 'Admin_panel\TableKeyController@setKey')->name('set_key');

// Группа роутов которые проходят проверку на существование ключа 'table_key' в cookies пользователя
Route::group([
    'middleware' => ['checkTableKey']
], function () {
    Route::post('/waiter_call', 'MenuPageController@waiterCallAjax')->name('waiter_call');
    Route::post('/productSingle', 'ProductSingleController@addToCart')->name('add_to_cart');
});

// Группа роутов для работы со страницей корзины
Route::group([
    'prefix' => 'cart',
    'middleware' => ['checkTableKey']
], function () {
    Route::get('/', 'CartController@index')->name('cart');
    Route::post('remove', 'CartController@removeFromCartAjax')->name('remove_product_ajax');
    Route::post('fullPrice', 'CartController@fullPriceAjax')->name('full_price_ajax');
    Route::get('confirm', 'CartController@confirmOrder')->name('confirm');
    Route::get('payTheBill', 'CartController@payTheBill')->name('pay_the_bill');
});

// Группа роутов для работы с панелью администратора, без статуса администратора
Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin-panel'
], function () {

    // Общие роуты
    Route::get('/', 'Admin_panel\MainPageController@index')->name('admin_panel_main');

    // Роуты для работы с виджетом официанта
    Route::post('openTable', 'Admin_panel\WaiterDashboardController@openTable')->name('open_table');
    Route::get('{invoice}/closeTable', 'Admin_panel\WaiterDashboardController@closeTable')->name('close_table');
    Route::get('{id}/accept', 'Admin_panel\WaiterDashboardController@acceptTable')->name('accept_table');
    Route::get('invoice/{invoice}', 'Admin_panel\InvoiceController@show')->name('invoice');
    Route::resource('carts', 'Admin_panel\CartsController')->only(['index', 'destroy']);
    Route::get('acceptCarts/{order}', 'Admin_panel\CartsController@acceptCarts')->name('accept_carts');

    // Роут который обрабатывает Ajax запрос с главной страницы панели администратора
    Route::post('/mainPageAjax', 'Admin_panel\MainPageController@answerAjax')->name('main_page_ajax');
});

// Группа роутов доступная только для пользователя со статусом администратора
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
    Route::post('product/changePositionAjax', 'Admin_panel\ProductsController@changePositionAjax')
        ->name('p_position_change');
    Route::post('product/change-status', 'Admin_panel\ProductsController@changeStatusAjax')
        ->name('change_product_status_ajax');

    //Staff->Manage
    Route::resource('users', 'Admin_panel\StaffController')->only(['index', 'store', 'destroy']);

    //Tables->Manage
    Route::resource('tables', 'Admin_panel\TablesController')->only(['index', 'store', 'destroy']);
});
