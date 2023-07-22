<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

use App\Http\Controllers\Auth\LoginRegisterController;

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
    return view('welcome');
});
Route::get('/welcome', [ProductController::class, 'index'])->name('welcome');
Route::get('/kategori', [ProductController::class, 'kategori'])->name('kategori');


Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
    

      
    
});

    Route::middleware('auth')->group(function () {
        Route::get('/shopping-cart', [ProductController::class, 'productCart'])->name('shopping.cart');
        Route::get('/product/{id}', [ProductController::class, 'addProducttoCart'])->name('addProduct.to.cart');
        Route::get('/productmin/{id}', [ProductController::class, 'minProducttoCart'])->name('minProduct.to.cart');
        Route::patch('/update-shopping-cart', [ProductController::class, 'updateCart'])->name('update.sopping.cart');
        Route::delete('/delete-cart-product', [ProductController::class, 'deleteProduct'])->name('delete.cart.product');
        Route::post('/cart', [CartController::class, 'store'])->name('cart.checkout');

        Route::get('/itemx', [ProductController::class, 'itemx'])->name('itemx');
        Route::get('/additem', [ProductController::class, 'itemadd'])->name('item.add');
        Route::post('/itemstore', [ProductController::class, 'itemstore'])->name('items.store');

        Route::resource('/item', \App\Http\Controllers\ProductController::class);

        Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
        Route::get('/products/searchh', [ProductController::class, 'searchh'])->name('products.searchh');

        Route::resource('/kategori', \App\Http\Controllers\CategoryController::class);

        Route::get('/kategori/search', [CategoryController::class, 'search'])->name('products.search');

    });