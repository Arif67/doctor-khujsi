<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Doctor extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'email',
        'phone',
        'office_phone',
        'department_id',
        'status',
        'photo',
        'description',
        'educations', 'shifts', 'social_links'
    ];

    protected $casts = [
        'educations' => 'array',
        'shifts' => 'array',
        'social_links' => 'array',
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }
}
