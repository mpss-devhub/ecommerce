<?php

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
    return view('product');
});

// Route::get('/product',[ProductPageController::class, 'showProductPage'])->name('product');
// Cart Module
// Route::get('/cart',               [CartController::class, 'index'])->name('cart.index');
// Route::get('/cart/store',         [CartController::class, 'store'])->name('cart.store');
// Route::get('/cart/update',        [CartController::class, 'update'])->name('cart.update');
// Route::get('/cart/delete/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
// Route::get('/cart/clear',         [CartController::class, 'clear'])->name('cart.clear');

//check out
// Route::middleware('auth')->group(function () {
//     Route::get('/checkout',  [CheckoutController::class, 'showCheckoutView'])->name('checkout');
//     Route::post('/checkout', [CheckoutController::class, 'submitCheckoutView'])->name('checkout.submit');
// });