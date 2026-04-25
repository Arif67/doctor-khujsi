<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorBookingStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_booking_id',
        'changed_by',
        'from_status',
        'to_status',
        'reason',
    ];

    public function booking()
    {
        return $this->belongsTo(DoctorBooking::class, 'doctor_booking_id');
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
