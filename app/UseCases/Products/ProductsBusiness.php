<?php

namespace App\UseCases\Products;

use App\Domain\Entities\Picture;
use App\Domain\Entities\Product;
use App\Http\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductsBusiness
{
    private ProductRepository $repository;
    
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function saveProduct(array $dto): ?Model
    {
        $picture = new Picture($dto['foto']);
        $product = new Product($dto['nome'], $dto['descricao'], $dto['valor'], $picture);
        
        return $this->repository->save($this->mountProduct($product));
    }

    public function updateProduct(array $dto)
    {
        $this->deleteCurrentPicture($dto);
        $picture = new Picture($dto['foto'] ?? $dto['foto_atual'] ?? '');
        $product = new Product($dto['nome'], $dto['descricao'], $dto['valor'], $picture);

        return $this->repository->update($this->mountProduct($product));
    }

    private function deleteCurrentPicture(&$dto)
    {
        if (empty($dto['foto'])) {
            return;
        }

        $file = explode('/', $dto['foto_atual']);
        Storage::delete($file[1] . '/' . $file[2]);
    }
    
    private function mountProduct(Product $product): array
    {
        return [
            'nome' => $product->getNome(),
            'descricao' => $product->getDescricao(),
            'valor' => $product->getValor(),
            'foto' => $product->getFoto(),
        ];
    }
}