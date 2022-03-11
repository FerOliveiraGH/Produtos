<?php

namespace App\Http\Repositories;

use App\Http\Models\ProductModel;
use Illuminate\Database\Eloquent\Model;

class ProductRepository
{
    private ProductModel $model;
    
    public function __construct(ProductModel $model)
    {
        $this->model = $model;
    }
    
    public function save(array $dto): ?Model
    {
        return $this->model->newQuery()->create($dto);
    }

    public function update(array $dto)
    {
        return $this->model->newQuery()->update($dto);
    }
}