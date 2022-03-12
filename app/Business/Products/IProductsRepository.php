<?php

namespace App\Business\Products;

use Illuminate\Contracts\Pagination\Paginator;

interface IProductsRepository
{
    public function getProduct(int $id): array;
    
    public function getProducts(): Paginator;

    public function create(array $dto): array;

    public function update(int $id, array $dto): int;
    
    public function delete(int $id): ?bool;
}