<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticsRuns extends Model
{
    use HasFactory;
    protected $table = 'statistics_runs';
    protected $fillable = [
        'start',
    ];
    protected $primaryKey = 'run_id';
}
