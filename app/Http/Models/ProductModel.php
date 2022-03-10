<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ProductModel extends Model
{
    protected $table = 'produtos';
    
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'nome','descricao','valor','foto'
    ];

    protected $dates = ['deleted_at','created_at', 'update_at'];
}
