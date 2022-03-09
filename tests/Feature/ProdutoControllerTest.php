<?php

use App\Http\Controllers\ProdutoController;
use Tests\TestCase;

class ProdutoControllerTest extends TestCase
{
    public function testObterProduto()
    {
        $controller = new ProdutoController();
        $response = $controller->index();
        $data = $response->getData();

        $this->assertNotEmpty($data);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('produtos', $data);
        $this->assertArrayHasKey('data', $data['produtos']);
    }
}