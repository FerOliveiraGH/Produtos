<?php

use App\Http\Controllers\ProdutoController;
use Tests\TestCase;

class ProdutoControllerTest extends TestCase
{
    public function testObterProduto()
    {
        $controller = new ProdutoController();
        $response = $controller->index();

        $this->assertTrue($response);
    }
}