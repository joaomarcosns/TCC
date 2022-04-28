<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoPlantas extends Model
{
    use HasFactory;

    protected $table = 'grupo_plantas';
    protected $id = 'id';
    protected $fillable = [
        'nome',
        'descricao',
    ];
    public $timestamps = true;

    public function plantas()
    {
        return $this->hasMany(Plantas::class, 'grupo_planta_id', 'id');
    }
}
