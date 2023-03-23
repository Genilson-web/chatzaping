<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespostaInicial extends Model
{
    use HasFactory;
    protected $fillable = [
        'resposta',
        'numero'
    ];
}
