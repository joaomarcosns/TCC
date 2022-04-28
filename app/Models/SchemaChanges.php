<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemaChanges extends Model
{
    use HasFactory;
    protected $table = 'schema_changes';
    protected $fillable = [
        'schema_version',
        'changed',
    ];
    protected $primaryKey = 'change_id';
}
