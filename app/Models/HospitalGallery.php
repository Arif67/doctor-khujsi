<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalGallery extends Model
{
    protected $fillable = [
        'owner_id',
        'title',
        'image',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
