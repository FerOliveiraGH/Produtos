<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Produto extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'nome','descricao','valor','foto'
    ];

    protected $dates = ['deleted_at','created_at', 'update_at'];
}
