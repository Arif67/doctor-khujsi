<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_owner_id',
        'reviewer_name',
        'reviewer_email',
        'rating',
        'review',
        'status',
        'admin_note',
        'moderated_by',
        'moderated_at',
    ];

    protected $casts = [
        'moderated_at' => 'datetime',
    ];

    public function hospital()
    {
        return $this->belongsTo(User::class, 'hospital_owner_id');
    }

    public function moderator()
    {
        return $this->belongsTo(User::class, 'moderated_by');
    }
}
