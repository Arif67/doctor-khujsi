<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Doctor extends Model
{
    use HasFactory;
     protected $fillable = [
        'owner_id',
        'name',
        'email',
        'phone',
        'office_phone',
        'department_id',
        'speciality',
        'experience',
        'status',
        'show_on_homepage',
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

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function bookings()
    {
        return $this->hasMany(DoctorBooking::class);
    }
}
