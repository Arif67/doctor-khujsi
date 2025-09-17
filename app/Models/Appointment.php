<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'appointment_id','patient_id','department_id','assign_by','appointment_date',
        'appointment_time','serial_no','message'
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class,'patient_id','id');
    }
    public function serviceHistory(){
        return $this->hasMany(ServiceHistory::class,'appointment_id','id');
    }
}
