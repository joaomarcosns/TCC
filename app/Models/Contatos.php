<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contatos extends Model
{
    use HasFactory;
    protected $table = 'contatos';
    protected $primaryKey = 'id';
    protected $fillable = [
        "telefone",
        "email",
        "propriedade_id",
    ];
    public $timestamps = true;

    public function propriedade()
    {
        return $this->belongsTo(Propriedade::class, 'propriedade_id', "id");
    }
}
