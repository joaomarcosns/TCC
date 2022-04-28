<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GDD extends Model
{
    use HasFactory;

    protected $table = 'gdd';
    protected $primaryKey = 'id';
    protected $fillable = [
        'gdd',
    ];
    public $timestamps = true;

}
