<?php

use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;

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

Auth::routes();
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/products', [ProductsController::class, 'index'])->name("products.index");

Route::get('/addToCart', [ProductsController::class, 'addToCart'])->name("products.addToCart");
Route::get('/cart', [ProductsController::class, 'cart'])->name('cart.index');
Route::get('/cart/update', [ProductsController::class, 'updateCart'])->name("cart.update");
Route::get('/cart/{id}', [ProductsController::class, 'destroyCart'])->name("cart.destroy");
Route::post('/cart/clear', [ProductsController::class, 'clear'])->name('cart.clear');

Route::middleware('auth')->group(function () {
    Route::match(['get', 'post'], '/checkout', [CheckOutController::class, 'checkout'])->name('checkout');
    Route::get('/redirect/checkout', [CheckOutController::class, 'redirectCheckOut'])->name('redirectCheckOut');
    Route::get('/history', [ProductsController::class, 'viewHistory'])->name('history');
});

Route::middleware('guest')->group(function () {
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

Auth::routes();
