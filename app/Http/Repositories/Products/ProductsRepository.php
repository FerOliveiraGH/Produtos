<?php

namespace App\Http\Repositories\Products;

use App\Business\Products\IProductsRepository;
use App\Http\Models\Products\ProductsModel;

class ProductsRepository implements IProductsRepository
{
    private ProductsModel $model;
    
    public function __construct(ProductsModel $model)
    {
        $this->model = $model;
    }
    
    public function create(array $dto): array
    {
        $response = $this->model->newQuery()->create($dto);

        if (empty($response)) {
            return [];
        }

        return $response->toArray();
    }

    public function update(array $dto): int
    {
        return $this->model->newQuery()->update($dto);
    }
}