<?php

namespace App\Http\Controllers;

use App\Http\Models\Products\ProductsModel;
use App\Business\Products\ProductsBusiness;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    private ProductsBusiness $business;

    public function __construct(ProductsBusiness $business)
    {
        $this->middleware('auth');
        $this->business = $business;
    }

    function viewProducts()
    {
        $products = $this->business->getProducts();
        return view('produtos', ['produtos' => $products]);
    }

    function viewCreateProduct()
    {
        return view('create');
    }

    function viewEditProduct($id)
    {
        $produto = ProductsModel::find($id);
        $produto['foto_atual'] = $produto['foto'] ?? '';
        return view('edit', ['produto' => $produto]);
    }

    public function createProduct(Request $request): RedirectResponse
    {
        if (!$this->business->createProduct($request->all())) {
            return redirect()
                ->route('produtos.create', '', Response::HTTP_BAD_REQUEST)
                ->with('error', 'Erro ao cadastrar o produto!');
        }

        return redirect()
            ->route('produtos', '', Response::HTTP_CREATED)
            ->with('status', 'Product criado com sucesso!');
    }

    public function updateProduct(Request $request): RedirectResponse
    {
        if (!$this->business->updateProduct($request->all())) {
            return redirect()
                ->route('produtos.create', '', Response::HTTP_BAD_REQUEST)
                ->with('error', 'Erro ao atualizar o produto!');
        }

        return redirect()
            ->route('produtos')
            ->with('status', 'Product atualizado com sucesso!');
    }

    public function deleteProduct($id): RedirectResponse
    {
        $produto = ProductsModel::find($id);
        if (isset($produto->foto) && !empty($produto->foto)) {
            $file = explode('/', $produto->foto);
            Storage::delete($file[1] . '/' . $file[2]);
        }
        $produto->delete();
        return redirect()->route('produtos')->with('status', 'Removido com sucesso!');
    }
}
