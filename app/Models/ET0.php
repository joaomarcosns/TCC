<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ET0 extends Model
{
    use HasFactory;

    protected $table = 'et0';
    protected $fillable = ['et0'];
    protected $primaryKey = 'id';
    public $timestamps = true;
}
