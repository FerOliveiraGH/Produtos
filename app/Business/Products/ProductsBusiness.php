<?php

namespace App\Business\Products;

use App\Domain\Products\Picture;
use App\Domain\Products\Product;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductsBusiness
{
    private IProductsRepository $repository;
    
    public function __construct(IProductsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getProducts(): Paginator
    {
        return $this->repository->getProducts();
    }
    
    public function createProduct(array $dto): array
    {
        $picture = new Picture($dto['foto']);
        $product = new Product($dto['nome'], $dto['descricao'], $dto['valor'], $picture);
        
        return $this->repository->create($this->mountProduct($product));
    }

    public function updateProduct(array $dto): int
    {
        $this->deleteCurrentPicture($dto);
        $picture = new Picture($dto['foto'] ?? $dto['foto_atual'] ?? '');
        $product = new Product($dto['nome'], $dto['descricao'], $dto['valor'], $picture);

        return $this->repository->update($this->mountProduct($product));
    }

    private function deleteCurrentPicture($dto)
    {
        if (!$dto['foto'] instanceof UploadedFile || empty($dto['foto_atual'])) {
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