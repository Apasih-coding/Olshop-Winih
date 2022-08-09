<?php

use App\Http\Controllers\SearchController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
// Route::get('/', 'PageController@index');

Route::middleware('can:admin-user')->group(function () {
    // User Manage
    Route::get('/admin', 'UserController@index');
    Route::get('/admin/user', 'UserController@indexManageUser');
    Route::get('/admin/{user:id}/editUser', 'UserController@adminedit');
    Route::patch('/admin/{user:id}/editUser', 'UserController@adminupdate');
    Route::delete('/admin/{user:id}/deleteUser', 'UserController@destroy');
    Route::get('/admin/{user:id}/detailUser', 'UserController@adminshow');
    // Product Manage
    Route::get('/admin/product', 'ProductController@productAdmin');
    Route::get('/product/create', 'ProductController@create');
    Route::post('/product/store', 'ProductController@store');
    Route::get('/admin/{product:slug}/edit', 'ProductController@edit');
    Route::patch('/admin/{product:slug}/edit', 'ProductController@update');
    Route::delete('/product/{product:slug}/delete', 'ProductController@destroy');
    Route::get('/admin/{product:slug}/detailProduct', 'ProductController@showProduct');
    Route::get('/admin/product/sorting-category', 'SearchController@sortir');
    // Order Manage
    Route::get('/admin/order', 'OrderController@indexAdmin');
    Route::get('/admin/{order:id}/detailOrder', 'OrderController@showAdmin');
    Route::get('/admin/{order:id}/orderDetail', 'OrderController@showOrder');
    Route::delete('/admin/{order:id}/deleteOrder', 'OrderController@destroy');
    Route::get('/admin/order/paid', 'OrderController@paidAdmin');
    Route::patch('/admin/{order:id}/confirm', 'OrderController@packing');
    Route::get('/admin/order/packing', 'OrderController@package');
    Route::patch('/admin/{order:id}/deliver', 'OrderController@deliver');
    Route::get('/admin/order/deliver', 'OrderController@delivering');
    Route::get('/admin/order/success', 'OrderController@success');
    // Pesan Manage
    Route::get('/admin/pesan', 'MessageController@index');
    Route::get('/admin/{message:id}/detailPesan', 'MessageController@show');
    Route::delete('/admin/pesan/{message:id}/delete', 'MessageController@destroy');
});
// Search
Route::get('search', 'SearchController@index')->name('search');
Route::get('search/pupuk', 'SearchController@pupuk')->name('search.pupuk');
Route::get('search/benih', 'SearchController@benih')->name('search.benih');
Route::get('search/peralatan', 'SearchController@peralatan')->name('search.peralatan');

// Cart
Route::get('/cart', 'CartController@index');
Route::post('/cart/add_cart', 'CartController@store')->name('add_cart');
Route::get('/cart/{cart:id}', 'CartController@show');
Route::post('/cart/{cart:id}', 'CartController@edit');
Route::get('cart/getData/{id}', 'CartController@ajax');
Route::patch('/cart/{cart:id}/tambah', 'CartController@tambah');
Route::patch('/cart/{cart:id}/minus', 'CartController@minus');
Route::delete('/cart/{cart:id}/delete', 'CartController@destroy');
// Order
Route::get('/myorders', 'OrderController@index');
Route::post('/myorders/add_order', 'OrderController@store');
Route::get('/myorders/{order:id}/bayar', 'OrderController@edit');
Route::patch('/myorders/{order:id}/ConfirmBayar', 'OrderController@update');
Route::delete('/myorders/{order:id}/delete', 'OrderController@destroy');
Route::get('/myorders/paid', 'OrderController@paid');
Route::get('/myorders/packing', 'OrderController@orderPaking');
Route::get('/myorders/deliver', 'OrderController@orderDeliver');
Route::patch('/myorders/ {order:id}/receive', 'OrderController@receive');
Route::get('/myorders/success', 'OrderController@orderSuccess');
Route::get('/myorders/{order:id}/detail', 'OrderController@show');
// About Us
Route::get('/about', 'MessageController@about');
Route::post('/message/add', 'MessageController@store');
// Account
Route::get('/myaccount', 'UserController@show');
Route::get('/myaccount/{user:id}/edit', 'UserController@edit');
Route::patch('/myaccount/{user:id}/edit', 'UserController@update');
Route::get('/myaccount/{user:id}/edit-password', 'UserController@editpassword');
Route::patch('/myaccount/{user:id}/edit-password', 'UserController@updatepassword');

// Product
Route::middleware('auth')->group(function () {
    Route::get('/product', 'ProductController@index')->withoutMiddleware('auth');
    Route::get('/{product:slug}', 'ProductController@show')->withoutMiddleware('auth');
});
