<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KcPlanta extends Model
{
    use HasFactory;
    protected $table = 'kc_planta';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cultura',
        'kc_poda',
        'dias_poda',
        'kc_cescimento',
        'dias_cescimento',
        'kc_producao',
        'dias_producao',
    ];
    public $timestamps = true;

    
}
