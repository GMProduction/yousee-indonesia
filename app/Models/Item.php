<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'city_id',
        'location',
        'url',
        'type_id',
        'position',
        'width',
        'height',
        'image1',
        'image2',
        'image3',
        'created_by',
        'last_update_by',
        'vendor_id',
        'qty',
        'side',
        'trafic',
        'isShow',
        'slug'
    ];

    protected $with = ['city', 'type'];


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function type()
    {
        return $this->belongsTo(type::class)->withDefault(['name' => '']);
    }


    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function vendorAll()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withDefault(['name' => ''])->withTrashed();
    }
}
