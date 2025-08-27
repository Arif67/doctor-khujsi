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
        'department_id',
        'qualification',
        'specialization',
        'status',
        'photo',
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }
}
