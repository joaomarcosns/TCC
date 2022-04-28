<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medidas extends Model
{
    use HasFactory;
    protected $table = 'medidas';
    protected $primaryKey = 'id';
    protected $fillable = [
        "altura_total",
        "largura_total",
        "comprimento_total",
        "hectares",
        "latitude",
        "longitude",
        "latitude_graus",
        "longitude_graus",
        "latitude_minutos",
        "longitude_minutos",
        "latitude_segundos",
        "longitude_segundos",
        "hemisferio"
    ];
    public $timestamps = true;

    public function propriedade()
    {
        return $this->hasOne(Propriedade::class,  'medida_id', "id");
    }
}
