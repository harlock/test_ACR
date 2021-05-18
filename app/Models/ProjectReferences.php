<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectReferences extends Model
{
    use HasFactory;
    protected $fillable = [
        'description', 'project_id',
    ];
}
