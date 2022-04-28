<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPodas extends Model
{
    use HasFactory;
    protected $table = 'data_das_podas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'data_poda',
        'setor_id'
    ];
    public $timestamps = true;

    public function setor()
    {
        return $this->hasMany(Setor::class, 'id', 'setor_id');
    }
}
