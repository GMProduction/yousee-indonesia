<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontArticle extends Model
{
    use HasFactory;

    protected $casts = [
        'tags' => 'array',
    ];
    protected $fillable = [
        'title',
        'image',
        'tags',
        'content',
        'slug'
    ];
}
