<?php

use App\Http\Controllers\DasboardController;
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
Route::get('/products/list', [ProductsController::class, 'list'])->name('product.list');
Route::get('/products/add', [ProductsController::class, 'new'])->name('product.new');
Route::post('/products/add', [ProductsController::class, 'store'])->name('product.new');
Route::get('/products/edit/{eid}', [ProductsController::class, 'edit'])->name('product.edit');
Route::post('/products/edit/{eid}', [ProductsController::class, 'update'])->name('product.edit');
Route::delete('/delete', [ProductsController::class, 'destroy'])->name('product.delete');
