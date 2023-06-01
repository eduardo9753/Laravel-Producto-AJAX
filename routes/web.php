<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProviderController;
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

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register/store', [RegisterController::class , 'store'])->name('register.store');

Route::post('/logout', [LogoutController::class , 'logout'])->name('logout');

Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login/store', [LoginController::class, 'store'])->name('login.store');

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

//AJAX PROUCTO
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::post('/product/save', [ProductController::class, 'save'])->name('product.save');
Route::get('/product/fetch/products', [ProductController::class, 'fetchProducts'])->name('product.fetch');
Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show');
Route::put('/product/update', [ProductController::class, 'update'])->name('product.update');
Route::post('/product/delete', [ProductController::class, 'delete'])->name('product.delete');



//AJAX PROOVEDOR
Route::get('/provider', [ProviderController::class, 'index'])->name('provider.index');
Route::post('/provider/save', [ProviderController::class, 'save'])->name('provider.save');
Route::get('/provider/fetch/providers', [ProviderController::class, 'fetchProviders'])->name('provider.fetch');
Route::get('/provider/show/{id}', [ProviderController::class, 'show'])->name('provider.show');
Route::put('/provider/update', [ProviderController::class, 'update'])->name('provider.update');
Route::post('/provider/delete', [ProviderController::class, 'delete'])->name('provider.delete');



//AJAX CATEGORIAS
Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/save', [CategoryController::class, 'save'])->name('category.save');
Route::get('/category/fetch/categories', [CategoryController::class, 'fecthCategories'])->name('category.fetch');
Route::get('/category/show/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::put('/category/update', [CategoryController::class, 'update'])->name('category.update');
