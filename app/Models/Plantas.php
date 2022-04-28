<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantas extends Model
{
    use HasFactory;
    
    protected $table = 'plantas';
    protected $id = 'id';
    protected $fillable = [
        'nome',
        'temperatura_base',
        'grupo_planta_id',
    ];
    public $timestamps = true;

    public function grupoPlanta()
    {
        return $this->belongsTo(GrupoPlantas::class, 'grupo_planta_id','id');
    }
}
