<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PatientPrescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'uploaded_by',
        'title',
        'doctor_name',
        'prescription_date',
        'medicines',
        'notes',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
    ];

    protected function casts(): array
    {
        return [
            'prescription_date' => 'date',
            'file_size' => 'integer',
        ];
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getFileUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->file_path);
    }
}
