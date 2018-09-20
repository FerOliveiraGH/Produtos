<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $produtos = Produto::orderBy('created_at', 'desc')->paginate(10);
        return view('produtos',['produtos' => $produtos]);
    }

    function createProduto(){
        return view('create');
    }

    function editProduto($id){
        $produto = Produto::find($id);
        return view('edit',['produto'=>$produto]);
    }

    public function storeProduto(Request $request){
        $path = 'storage/fotos/';
        $produto = new Produto;
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->valor = $request->valor;
        if(isset($request->foto)){
        $foto = auth()->user()->id.'-'.time().'-'.$request->foto->getClientOriginalName();
            $upload = $request->foto->storeAs('fotos', $foto);
            if($upload){
                $produto->foto = $path.$foto;
            }else{
                return redirect()->route('produtos.create')->with('error', 'Erro ao cadastrar o produto!');
            }
        }
        $produto->save();
        return redirect()->route('produtos')->with('status', 'Produto criado com sucesso!');
    }

    public function updateProduto(Request $request){
        $path = 'storage/fotos/';
        $produto = Produto::findOrFail($request->id);
        $produto->nome        = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->valor    = $request->valor;
        if(isset($request->foto)){
        $file = explode('/',$produto->foto);
        Storage::delete($file[1].'/'.$file[2]);
        $foto = auth()->user()->id.'-'.time().'-'.$request->foto->getClientOriginalName();
            $upload = $request->foto->storeAs('fotos', $foto);
            if($upload){
                $produto->foto = $path.$foto;
            }else{
                return redirect()->route('produtos.create')->with('error', 'Erro ao cadastrar o produto!');
            }
        }
        $produto->save();
        return redirect()->route('produtos')->with('status', 'Produto atualizado com sucesso!');
    }

    public function deleteProduto($id){
        $produto = Produto::find($id);
        if(isset($produto->foto)){
            $file = explode('/',$produto->foto);
            Storage::delete($file[1].'/'.$file[2]);
        }
        $produto->delete();
        return redirect()->route('produtos')->with('status', 'Removido com sucesso!');
    }

}
