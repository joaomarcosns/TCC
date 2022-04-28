<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticsMeta extends Model
{
    use HasFactory;
    protected $table = 'statistics_meta';
    protected $fillable = [
        'statistics_id',
        'source',
        'unit_of_measurement',
        'has_mean',
        'has_sum',
        'name',
    ];
    protected $primaryKey = 'id';
}
