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
        'title_id',
        'title_en',
        'image',
        'tags',
        'content',
        'content_id',
        'content_en',
        'slug',
        'sort_desc',
        'sort_desc_id',
        'sort_desc_en'
    ];
}
