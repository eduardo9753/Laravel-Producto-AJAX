<?php

use App\Http\Controllers\admin\auth\RegisterController;
use App\Http\Controllers\admin\auth\LogoutController;
use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\admin\caja\CajaController;
use App\Http\Controllers\admin\category\CategoryController;
use App\Http\Controllers\admin\juice\JuiceController;
use App\Http\Controllers\admin\provider\ProviderController;
use App\Http\Controllers\admin\supply\SupplyController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\cliente\ContactoControllerCliente;
use App\Http\Controllers\cliente\HomeControllerCliente;
use App\Http\Controllers\cliente\MenuControllerCliente;
use App\Http\Controllers\MailController;
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

//RUTAS PARA EL CLIENTE
Route::get('/', [HomeControllerCliente::class, 'index'])->name('inicio.index');
Route::get('/menu', [MenuControllerCliente::class, 'index'])->name('menu.index');
Route::get('/menu/tipo/{id}', [MenuControllerCliente::class, 'show'])->name('menu.show');
Route::get('/contacto', [ContactoControllerCliente::class, 'index'])->name('contacto.index');




//RUTAS PARA EL ADMINISTRADOR
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/store', [LoginController::class, 'store'])->name('login.store');

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

//CORREO GMAIL
Route::get('/mail', [MailController::class, 'index'])->name('mail.index');
Route::post('/mail/send', [MailController::class, 'send'])->name('mail.send');
Route::get('/mail/recuperar', [MailController::class, 'recover'])->name('mail.recover');
Route::post('/mail/store', [MailController::class, 'store'])->name('mail.store');


//CAJA
Route::get('/caja', [CajaController::class, 'index'])->name('caja.index');
Route::post('/caja/save', [CajaController::class, 'save'])->name('caja.save');
Route::delete('/caja/save', [CajaController::class, 'delete'])->name('caja.delete');


//AJAX PROUCTO
Route::get('/juice', [JuiceController::class, 'index'])->name('juice.index');
Route::post('/juice/save', [JuiceController::class, 'save'])->name('juice.save');
Route::get('/juice/fetch/juices', [JuiceController::class, 'fetchJuices'])->name('juice.fetch');
Route::get('/juice/show/{id}', [JuiceController::class, 'show'])->name('juice.show');
Route::put('/juice/update', [JuiceController::class, 'update'])->name('juice.update');
Route::post('/juice/delete', [JuiceController::class, 'delete'])->name('juice.delete');


//SUPPLIES
Route::get('/supply', [SupplyController::class, 'index'])->name('supply.index');
Route::post('/supply/save', [SupplyController::class, 'save'])->name('supply.save');
Route::get('/supply/fetch/supply', [SupplyController::class, 'fetchSupplies'])->name('supply.fetch');
Route::get('/supply/show/{id}', [SupplyController::class, 'show'])->name('supply.show');
Route::put('/supply/update', [SupplyController::class, 'update'])->name('supply.update');
Route::post('/supply/delete', [SupplyController::class, 'delete'])->name('supply.delete');


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
Route::post('/category/delete', [CategoryController::class, 'delete'])->name('category.delete');
