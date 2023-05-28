<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Models\Product;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::post('/product/save', [ProductController::class, 'save'])->name('product.save');
Route::get('/product/fetch/products', [ProductController::class, 'fetchProducts'])->name('product.fetch');
Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show');
Route::put('/product/update', [ProductController::class, 'update'])->name('product.update');
Route::post('/product/delete', [ProductController::class, 'delete'])->name('product.delete');
