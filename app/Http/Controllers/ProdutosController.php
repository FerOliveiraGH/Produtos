<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use Illuminate\Support\Facades\Storage;

class ProdutosController extends Controller
{

    function index(Produto $produto){
       return $produto->all();
    }

    function show(Produto $produto){
       return $produto;
    }

    function store(Request $request,Produto $produto){
        $data = $produto->create($request->all());
        return $data;
    }

    function update(Request $request, Produto $produto){
        $produto->update($request->all());
        return $produto;
    }

    public function destroy(Produto $produto){
        $produto->delete();
        return $produto;
    }

}
