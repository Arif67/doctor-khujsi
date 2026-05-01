<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationArea extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'id',
        'thana_id',
        'name',
        'bn_name',
        'url',
    ];

    public function thana()
    {
        return $this->belongsTo(LocationThana::class, 'thana_id');
    }
}
