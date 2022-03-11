<?php

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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;

Auth::routes();

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rotas Produtos
Route::get('/produtos', [ProductsController::class, 'viewProducts'])->name('produtos');
Route::get('/produtos/create', [ProductsController::class, 'viewCreateProduct'])->name('produtos.create');
Route::get('/produtos/edit/{id}', [ProductsController::class, 'viewEditProduct'])->name('produtos.edit');
Route::post('/produtos/store', [ProductsController::class, 'createProduct'])->name('produtos.store');
Route::post('/produtos/update', [ProductsController::class, 'updateProduct'])->name('produtos.update');
Route::get('/produtos/delete/{id}', [ProductsController::class, 'deleteProduct'])->name('produtos.delete');
