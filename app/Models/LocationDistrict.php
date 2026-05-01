<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationDistrict extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'id',
        'division_id',
        'name',
        'bn_name',
        'lat',
        'lon',
        'url',
    ];

    public function thanas()
    {
        return $this->hasMany(LocationThana::class, 'district_id');
    }
}
