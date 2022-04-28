<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    use HasFactory;
    protected $table = 'statistics';
    protected $fillable = [
        'created',
        'start',
        'mean',
        'min',
        'max',
        'last_reset',
        'state',
        'sum',
        'metadata_id',
    ];
    protected $primaryKey = 'id';
}
