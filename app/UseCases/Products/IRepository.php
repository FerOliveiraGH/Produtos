<?php

namespace App\UseCases\Products;

use Illuminate\Database\Eloquent\Model;

interface IRepository
{
    public function __construct(Model $model);
    
    public function save(array $dto);
}