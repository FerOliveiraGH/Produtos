<?php

namespace App\Http\Controllers;

use App\Http\Models\ProductModel;
use App\UseCases\Products\ProductsBusiness;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ProdutoController extends Controller
{
    private ProductsBusiness $business;

    public function __construct(ProductsBusiness $business)
    {
        $this->middleware('auth');
        $this->business = $business;
    }

    function index()
    {
        $produtos = ProductModel::query()->orderBy('created_at', 'desc')->paginate(10);
        return view('produtos', ['produtos' => $produtos]);
    }

    function createProduto()
    {
        return view('create');
    }

    function editProduto($id)
    {
        $produto = ProductModel::find($id);
        $produto['foto_atual'] = $produto['foto'] ?? '';
        return view('edit', ['produto' => $produto]);
    }

    public function storeProduto(Request $request): RedirectResponse
    {
        if (!$this->business->saveProduct($request->all())) {
            return redirect()
                ->route('produtos.create', '', Response::HTTP_BAD_REQUEST)
                ->with('error', 'Erro ao cadastrar o produto!');
        }

        return redirect()
            ->route('produtos', '', Response::HTTP_CREATED)
            ->with('status', 'Produto criado com sucesso!');
    }

    public function updateProduto(Request $request)
    {
        if (!$this->business->updateProduct($request->all())) {
            return redirect()
                ->route('produtos.create', '', Response::HTTP_BAD_REQUEST)
                ->with('error', 'Erro ao atualizar o produto!');
        }

        return redirect()
            ->route('produtos')
            ->with('status', 'Produto atualizado com sucesso!');
    }

    public function deleteProduto($id)
    {
        $produto = ProductModel::find($id);
        if (isset($produto->foto) && !empty($produto->foto)) {
            $file = explode('/', $produto->foto);
            Storage::delete($file[1] . '/' . $file[2]);
        }
        $produto->delete();
        return redirect()->route('produtos')->with('status', 'Removido com sucesso!');
    }
}
