<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;
    protected $table = 'setor';
    protected $primaryKey = 'id';
    protected $fillable = [
        'identificador',
        'area_id',
        'kc',
        'status',
        'etc'
    ];
    public $timestamps = true;

    public function propriedade()
    {
        return $this->hasMany(Propriedade::class);
    }

    public function data_poda()
    {
        return $this->hasOne(DataPodas::class, 'setor_id', 'id');
    }
}
