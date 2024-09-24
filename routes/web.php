<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name("home");
Route::get('/products', [ProductsController::class, 'index'])->name("products.index");

Route::get('/addToCart', [ProductsController::class, 'addToCart'])->name("products.addToCart");
Route::get('/cart', [ProductsController::class, 'cart'])->name('cart.index');
Route::get('/cart/update', [ProductsController::class, 'updateCart'])->name("cart.update");
Route::get('/cart/{id}', [ProductsController::class, 'destroyCart'])->name("cart.destroy");
Route::post('/cart/clear', [ProductsController::class, 'clear'])->name('cart.clear');

Route::get('/checkout', [ProductsController::class, 'checkout'])->name('checkout');
