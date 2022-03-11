<?php

namespace Tests\Feature;

use App\Http\Controllers\ProductsController;
use App\Http\Models\Products\ProductsModel;
use App\Http\Repositories\Products\ProductsRepository;
use App\Business\Products\ProductsBusiness;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProdutoControllerTest extends TestCase
{
    public function testObterProduto()
    {
        $controller = new ProductsController(new ProductsBusiness(new ProductsRepository(new ProductsModel())));
        $response = $controller->viewProducts();
        $data = $response->getData();

        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('produtos', $data);
        $this->assertNotEmpty($data['produtos']);
    }

    public function testSalvarProduto()
    {
        $controller = new ProductsController(new ProductsBusiness(new ProductsRepository(new ProductsModel())));
        $request = new Request([
            'nome' => uniqid(),
            'descricao' => 'teste',
            'valor' => '123',
            'foto' => ''
        ]);
        $response = $controller->createProduct($request);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }
}