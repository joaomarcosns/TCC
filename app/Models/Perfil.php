<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    protected $table = 'perfil';
    protected $primaryKey = 'id';
    protected $fillable = ['perfil', 'nivel_acesso'];
    public $timestamps = true;

    public function usuario()
    {
        return $this->hasOne(Usuario::class);
    }
}
