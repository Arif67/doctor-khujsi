<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationThana extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'id',
        'district_id',
        'name',
        'bn_name',
        'url',
    ];

    public function district()
    {
        return $this->belongsTo(LocationDistrict::class, 'district_id');
    }

    public function areas()
    {
        return $this->hasMany(LocationArea::class, 'thana_id');
    }
}
