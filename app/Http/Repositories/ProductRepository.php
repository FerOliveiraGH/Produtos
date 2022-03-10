<?php

namespace App\Http\Repositories;

use App\UseCases\Products\IRepository;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements IRepository
{
    private Model $model;
    
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
    public function save(array $dto): bool
    {
        return $this->model->save($dto);
    }
}