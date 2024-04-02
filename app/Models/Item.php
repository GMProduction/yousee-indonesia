<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $with = ['city','type'];


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function type()
    {
        return $this->belongsTo(type::class)->withDefault(['name' => '']);
    }
}
