<?php

namespace App\Http\Repositories\Products;

use App\Business\Products\IProductsRepository;
use App\Http\Models\Products\ProductsModel;
use Illuminate\Contracts\Pagination\Paginator;

class ProductsRepository implements IProductsRepository
{
    private ProductsModel $model;
    
    public function __construct(ProductsModel $model)
    {
        $this->model = $model;
    }
    
    public function getProduct(int $id): array
    {
        $response =  $this->model->newQuery()->find($id);
        
        if (empty($response)) {
            return [];
        }
    
        return $response->toArray();
    }
    
    public function getProducts(): Paginator
    {
        return $this->model->newQuery()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
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
    
    public function delete(int $id): ?bool
    {
        return $this->model->newQuery()
            ->where('id', $id)
            ->delete();
    }
}