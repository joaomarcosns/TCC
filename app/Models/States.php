<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    use HasFactory;
    protected $table = 'states';
    protected $fillable = [
        'domain',
        'entity_id',
        'state',
        'attributes',
        'event_id',
        'last_changed',
        'last_updated',
        'created',
        'old_state_id',
    ];
    protected $primaryKey = 'state_id';
    
}
