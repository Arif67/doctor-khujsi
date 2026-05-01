<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    use HasFactory;

    protected $table = 'service_histories';
    protected $fillable = ['appointment_id','doctor_id','patient_id','service_id','status', 'service_date',
    'service_time'];

    protected function casts(): array
    {
        return [
            'service_date' => 'date',
        ];
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class,'doctor_id','id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
