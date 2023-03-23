<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'numero'
    ];
    public function message()
    {
        return $this->hasMany(Message::class);
    }
    public function client()
    {
        return $this->hasMany(Client::class);
    }

    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }
    public function statu()
    {
        return $this->belongsTo(Statu::class);
    }
}
