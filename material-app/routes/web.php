<?php

use App\Http\Controllers\DasboardController;
use App\Http\Controllers\Delivery\DeliveryController;
use App\Http\Controllers\Delivery\DeliveryDataController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\PaymentDataController;
use App\Http\Controllers\ProductsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [DasboardController::class, 'dashboard'])->name('dashboard');

// URL untuk halaman produk
Route::prefix('/products')->group(function(){
    Route::get('/', [ProductsController::class, 'list'])->name('product.list');
    Route::get('/add', [ProductsController::class, 'new'])->name('product.new');
    Route::post('/add', [ProductsController::class, 'store'])->name('product.new');
    Route::get('/edit/{pid}', [ProductsController::class, 'edit'])->name('product.edit');
    Route::post('/edit/{pid}', [ProductsController::class, 'update'])->name('product.edit');
    Route::delete('/delete', [ProductsController::class, 'destroy'])->name('product.delete');
});

// URL untuk halaman produk
Route::prefix('/delivery')->group(function(){
    Route::get('/', [DeliveryController::class, 'list'])->name('delivery.list');
    Route::get('/add', [DeliveryController::class, 'new'])->name('delivery.new');
    Route::post('/add', [DeliveryController::class, 'store'])->name('delivery.new');
    Route::get('/edit/{did}', [DeliveryController::class, 'edit'])->name('delivery.edit');
    Route::post('/edit/{did}', [DeliveryController::class, 'update'])->name('delivery.edit');
    Route::delete('/delete', [DeliveryController::class, 'destroy'])->name('delivery.delete');
    // Data JSON Deliveries
    Route::get('/data-json', [DeliveryDataController::class, 'dt'])->name('delivery.data_json');
});

// URL untuk halaman Pembayaran
Route::prefix('/Payment')->group(function(){
    Route::get('/', [PaymentController::class, 'list'])->name('payment.list');
    Route::get('/add', [PaymentController::class, 'new'])->name('payment.new');
    Route::post('/add', [PaymentController::class, 'store'])->name('payment.new');
    Route::get('/edit/{did}', [PaymentController::class, 'edit'])->name('payment.edit');
    Route::post('/edit/{did}', [PaymentController::class, 'update'])->name('payment.edit');
    Route::delete('/delete', [PaymentController::class, 'destroy'])->name('payment.delete');
    // Data JSON Deliveries
    Route::get('/data-json', [PaymentDataController::class, 'dt'])->name('payment.data_json');
});
