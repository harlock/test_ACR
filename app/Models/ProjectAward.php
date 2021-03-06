<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAward extends Model
{
    use HasFactory;

    protected $fillable  = [
        'date', 'project_id', 'award_id'
    ];
}
