<?php
//TODO Очистить корзину пользователя если у него нет активного ключа столика.
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

//TODO при выходе из аккаунта удалять ключ столика
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/setKey', 'Admin_panel\TableKeyController@setKey')->name('set_key');
Route::get('/productSingle/{product}', 'ProductSingleController@index')->name('product_single');

//Группа роутов которые проходят проверку  на существование ключа 'table_key' в cookies пользователя
Route::group([
    'middleware' => ['checkTableKey']
], function () {
    Route::get('/call_waiter', 'ActionsFromMenuController@callWaiter')->name('waiter_call');
    Route::post('/productSingle', 'ProductSingleController@addToCart')->name('add_to_cart');
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/cart/remove', 'CartController@removeFromCartAjax')->name('remove_product_ajax');
    Route::post('/cart/fullPrice', 'CartController@fullPriceAjax')->name('full_price_ajax');
    Route::get('/cart/confirm', 'CartController@confirmOrder')->name('confirm');
    Route::get('/cart/payTheBill', 'CartController@payTheBill')->name('pay_the_bill');
});


//Admin panel rout groups

//Dashboard

//All registered users have this ability
Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin-panel'
], function () {
    Route::get('', 'Admin_panel\MainPageController@index')->name('admin_panel_main');

    //Запросы из панели официанта
    Route::post('openTable', 'Admin_panel\WaiterDashboardController@openTable')->name('open_table');
    Route::get('{invoice}/closeTable', 'Admin_panel\WaiterDashboardController@closeTable')->name('close_table');
    //Если столик в статусе Call то переход по этому роуту изменит статус на open
    Route::get('{id}/accept', 'Admin_panel\WaiterDashboardController@acceptTable')->name('accept_table');
    //Запрос на вывод счета
    Route::get('invoice/{invoice}', 'Admin_panel\InvoiceController@show')->name('invoice');

    //В cart содержатся продукты которые были заказаны
    Route::resource('carts', 'Admin_panel\CartsController');
    Route::get('acceptCarts/{order}', 'Admin_panel\CartsController@acceptCarts')->name('accept_carts');

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
    Route::post('product/changePosition', 'Admin_panel\ProductsController@changePosition')->name('p_position_change');
    Route::post('product/change-status', 'Admin_panel\ProductsController@changeStatusAjax')
        ->name('change_product_status_ajax');

    //Staff->Manage
    Route::resource('users', 'Admin_panel\StaffController')->only(['index', 'store', 'destroy']);

    //Tables->Manage
    Route::resource('tables', 'Admin_panel\TablesController');
});


