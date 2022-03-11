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
use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rota Produtos
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos');
Route::get('/produtos/create', [ProdutoController::class, 'createProduto'])->name('produtos.create');
Route::get('/produtos/edit/{id}', [ProdutoController::class, 'editProduto'])->name('produtos.edit');
Route::post('/produtos/store', [ProdutoController::class, 'storeProduto'])->name('produtos.store');
Route::post('/produtos/update', [ProdutoController::class, 'updateProduto'])->name('produtos.update');
Route::get('/produtos/delete/{id}', [ProdutoController::class, 'deleteProduto'])->name('produtos.delete');
