<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecorderRuns extends Model
{
    use HasFactory;
    protected $table = 'recorder_runs';
    protected $fillable = [
        'start',
        'end',
        'closed_incorrect',
        'created',
    ];
    protected $primaryKey = 'run_id';
}
