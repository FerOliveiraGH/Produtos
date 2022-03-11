<?php

namespace Tests\Feature;

use App\Http\Controllers\ProdutoController;
use App\Http\Models\ProductModel;
use App\Http\Repositories\ProductRepository;
use App\UseCases\Products\ProductsBusiness;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProdutoControllerTest extends TestCase
{
    public function testObterProduto()
    {
        $controller = new ProdutoController(new ProductsBusiness(new ProductRepository(new ProductModel())));
        $response = $controller->index();
        $data = $response->getData();

        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('produtos', $data);
        $this->assertNotEmpty($data['produtos']);
    }

    public function testSalvarProduto()
    {
        $controller = new ProdutoController(new ProductsBusiness(new ProductRepository(new ProductModel())));
        $request = new Request([
            'nome' => uniqid(),
            'descricao' => 'teste',
            'valor' => '123',
            'foto' => ''
        ]);
        $response = $controller->storeProduto($request);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }
}