<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'hospital_owner_id',
        'patient_name',
        'patient_phone',
        'patient_email',
        'patient_age',
        'notes',
        'status',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function hospitalOwner()
    {
        return $this->belongsTo(User::class, 'hospital_owner_id');
    }

    public function statusHistory()
    {
        return $this->hasMany(DoctorBookingStatusHistory::class)->latest();
    }
}
