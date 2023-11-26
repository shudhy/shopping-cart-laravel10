<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\OngkirController;

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



Route::get('/products/searchh', [ProductController::class, 'searchh'])->name('products.searchh');
Route::get('/welcome', [ProductController::class, 'index'])->name('welcome');



Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');

    
    

      
    
});

    Route::middleware('auth')->group(function () {
        
        
        Route::get('/select2item', [ProductController::class, 'select2item'])->name('product.select2item');
        Route::get('/shopping-cart', [ProductController::class, 'productCart'])->name('shopping.cart');
        Route::get('/product/{id}', [ProductController::class, 'addProducttoCart'])->name('addProduct.to.cart');
        Route::get('/productmin/{id}', [ProductController::class, 'minProducttoCart'])->name('minProduct.to.cart');
        Route::patch('/update-shopping-cart', [ProductController::class, 'updateCart'])->name('update.sopping.cart');
        Route::delete('/delete-cart-product', [ProductController::class, 'deleteProduct'])->name('delete.cart.product');
        Route::post('/cart', [CartController::class, 'store'])->name('cart.checkout');

        Route::PUT('/update-quantities', [CartController::class, 'updateQuantities'])->name('update.quantities');
        Route::put('/carts/{cart}/update-status', [CartController::class, 'updateStatus'])->name('update-status');

        Route::get('/itemx', [ProductController::class, 'itemx'])->name('itemx');
        Route::get('/additem', [ProductController::class, 'itemadd'])->name('item.add');
        Route::post('/itemstore', [ProductController::class, 'itemstore'])->name('items.store');
        Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
        Route::resource('/item', \App\Http\Controllers\ProductController::class);
        Route::get('/get-satuan/{productId}', [ProductController::class, 'getsatuan'])->name('get.satuan');
        Route::get('/get-units/{productID}', [ProductController::class, 'getUnitsByProduct']);



        Route::get('/get-harga/{priceId}', [ProductController::class, 'getHarga'])->name('get.harga');
        Route::get('/get-harga2/{priceId}', [ProductController::class, 'getHarga2'])->name('get.harga2');
        


        

        Route::get('/kategori/search', [CategoryController::class, 'search'])->name('kategori.search');
        Route::resource('/kategori', \App\Http\Controllers\CategoryController::class);
       
        Route::get('/users/search', [UsersController::class, 'search'])->name('users.search');
        Route::resource('/users', \App\Http\Controllers\UsersController::class);
        Route::get('/ongkirs/search', [OngkirController::class, 'search'])->name('ongkirs.search');
        Route::resource('/ongkirs', \App\Http\Controllers\OngkirController::class);
        
        Route::get('/gantipassword/{id}', [UsersController::class, 'gantipassword'])->name('users.gantipassword');
        Route::put('/gantipassword/{id}', [UsersController::class, 'updatepassword'])->name('update.gantipassword');

    
        Route::get('/laporan/tes1', [PenjualanController::class,'tes1'])->name('tes1');
        Route::get('/laporan/search', [PenjualanController::class,'laporansearch'])->name('laporan.search');
        Route::resource('/laporan', \App\Http\Controllers\PenjualanController::class);
        Route::resource('/detailpenjualan', \App\Http\Controllers\DetailPenjualanController::class);
        Route::get('/getUsers', [UsersController::class, 'getUsers'])->name('users.select2');
        Route::get('/tesselect2', [UsersController::class, 'showselect'])->name('users.showslect2');

        Route::post('/storeitem', [CartController::class, 'storeitem'])->name('store.item');
        Route::get('/tes', [CartController::class, 'tes'])->name('tes');

        Route::delete('/delete-item/{id}', [CartController::class, 'delete'])->name('deleteCartItem');

    });