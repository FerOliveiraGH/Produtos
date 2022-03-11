<?php

namespace App\Business\Products;

interface IProductsRepository
{
    public function create(array $dto): array;

    public function update(array $dto): int;
}