<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = "favorites";

    protected $fillable = ['patient_id','doctor_id'];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
