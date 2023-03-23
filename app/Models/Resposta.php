<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    use HasFactory;
    protected $fillable = [
        'resposta',
        'numero'
    ];
    public function setor()
    {
        return $this->hasMany(Setor::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
