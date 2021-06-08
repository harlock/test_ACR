<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageAuthor extends Model
{
    use HasFactory;
    protected $fillable=[
      'image_id', 'content_author_id'
    ];
}
