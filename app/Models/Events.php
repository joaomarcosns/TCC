<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'event_type',
        'event_data',
        'origin',
        'time_fired',
        'created',
        'context_id',
        'context_user_id',
        'context_parent_id',
    ];
    protected $primaryKey = 'event_id';
}
