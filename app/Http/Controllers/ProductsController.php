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
        $product = $this->business->getProduct($id);
        return view('edit', ['produto' => $product]);
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
        if (!$this->business->deleteProduct($id)) {
            return redirect()
                ->route('produtos', '', Response::HTTP_BAD_REQUEST)
                ->with('error', 'Erro ao remover o produto!');
        }
        
        return redirect()
            ->route('produtos')
            ->with('status', 'Produto removido com sucesso!');
    }
}
