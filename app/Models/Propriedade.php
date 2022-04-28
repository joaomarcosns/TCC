<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propriedade extends Model
{
    use HasFactory;
    protected $table = 'propriedade';
    protected $primaryKey = 'id';
    protected $fillable = [
        "nome_proprietario",
        "nome_propriedade",
        "rua",
        "numero",
        "bairro",
        "cidade",
        "cep",
        "estado",
        "medida_id",
    ];
    public $timestamps = true;

    public function medidas()
    {
        return $this->belongsTo(Medidas::class, 'medida_id', "id");
    }

    public function contatos()
    {
        return $this->hasOne(Contatos::class, 'propriedade_id', "id");
    }
}
