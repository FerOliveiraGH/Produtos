<?php

namespace Tests\Feature;

use App\Http\Controllers\ProdutoController;
use App\Http\Models\ProductModel;
use App\Http\Repositories\ProductRepository;
use App\UseCases\Products\ProductsBusiness;
use Tests\TestCase;

class ProdutoControllerTest extends TestCase
{
    public function testObterProduto()
    {
        $controller = new ProdutoController(new ProductsBusiness(new ProductRepository(new ProductModel())));
        $response = $controller->index();
        $data = $response->getData();

        $this->assertNotEmpty($data);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('produtos', $data);
        $this->assertArrayHasKey('data', $data['produtos']);
    }
}