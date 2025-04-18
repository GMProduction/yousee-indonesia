<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontService extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'name_id',
        'name_en',
        'description',
        'description_id',
        'description_en',
    ];
}
