<?php

namespace App\UseCases\Products;

use App\Domain\Entities\Product;

class ProductsBusiness
{
    private IRepository $repository;
    
    public function __construct(IRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function saveProduct(array $dto): bool
    {
        $product = new Product($dto['nome'], $dto['descricao'], $dto['valor'], $dto['foto']);
        
        return $this->repository->save($this->mountProduct($product));
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