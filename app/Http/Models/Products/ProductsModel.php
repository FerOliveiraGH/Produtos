<?php

namespace App\Http\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ProductsModel extends Model
{
    protected $table = 'produtos';
    
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'id', 'nome','descricao','valor','foto'
    ];

    protected $dates = ['deleted_at','created_at', 'update_at'];
}
