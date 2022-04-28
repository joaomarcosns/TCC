<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'area';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome',
        'descricao',
        'propriedade_id',
    ];
    public $timestamps = true;

    public function propriedade()
    {
        return $this->hasMany(Propriedade::class);
    }

    public function setor()
    {
        return $this->hasOne(Setor::class);
    }
}
