<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    Route::resource('/user', 'UserController');
    Route::resource('/role', 'RoleController');

    Route::resource('/Client', 'ClientController');

});

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

//Item Routes
    Route::resource('/items', 'ItemController');

    Route::resource('/stock-orders', 'StockOrdersController');
    Route::post('/stock-orders', 'StockOrdersController@store')->name('stock_orders.store');
    Route::get('/stock-orders/{stock_order}/edit', 'StockOrdersController@update')->name('stock_orders.edit');
     Route::post('/stock-order-receive/{stockOrder}', 'StockOrdersController@receive')->name('stock-orders.receive');
    Route::post('/stock-orders/{stock_order}/destroy', 'StockOrdersController@destroy')->name('stock_orders.destroy');
//Cus Routes
    Route::resource('/customer', 'CustomerController');



Route::get('/about', function () {
    return view('about');
})->name('about');
