<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statu extends Model
{
    use HasFactory;
    protected $fillable = [
        'ativo'
    ];
    public function atendente()
    {
        return $this->hasMany(Atendente::class);
    }
}
