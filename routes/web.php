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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Rota Produtos
Route::get('/produtos', 'ProdutoController@index')->name('produtos');
Route::get('/produtos/create', 'ProdutoController@createProduto')->name('produtos.create');
Route::get('/produtos/edit/{id}', 'ProdutoController@editProduto')->name('produtos.edit');
Route::post('/produtos/store', 'ProdutoController@storeProduto')->name('produtos.store');
Route::post('/produtos/update', 'ProdutoController@updateProduto')->name('produtos.update');
Route::get('/produtos/delete/{id}', 'ProdutoController@deleteProduto')->name('produtos.delete');
