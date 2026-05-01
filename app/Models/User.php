<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'hospital_name',
        'about_hospital',
        'phone',
        'email',
        'mobile',
        'blood',
        'gender',
        'sex',
        'date_of_birth',
        'photo',
        'address',
        'hospital_location',
        'privacy_policy',
        'district',
        'thana',
        'area',
        'plan_password',        
        'password',
        'approval_status',
        'approved_at',
        'rejection_reason',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'approved_at' => 'datetime',
        ];
    }

    public function getNameAttribute(): string
    {
        return trim(implode(' ', array_filter([$this->first_name, $this->last_name])));
    }

    public function setNameAttribute(?string $value): void
    {
        $value = trim((string) $value);
        $parts = preg_split('/\s+/', $value, 2) ?: [];

        $this->attributes['first_name'] = $parts[0] ?? '';
        $this->attributes['last_name'] = $parts[1] ?? null;
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'owner_id');
    }

    public function doctorBookings()
    {
        return $this->hasMany(DoctorBooking::class, 'hospital_owner_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'owner_id');
    }

    public function hospitalGalleries()
    {
        return $this->hasMany(HospitalGallery::class, 'owner_id');
    }

    public function hospitalReviews()
    {
        return $this->hasMany(HospitalReview::class, 'hospital_owner_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(Doctor::class, 'favorites', 'patient_id', 'doctor_id');
    }
    public function favoritesCount()
    {
        return $this->favorites()->count();
    }

   public function appointments()
   {
        return $this->hasMany(Appointment::class, 'patient_id', 'id');
    }

    public function appointmentsCount()
    {
        return $this->appointments()->count();
    }

    public function serviceHistory(){
        return $this->hasMany(ServiceHistory::class,'patient_id','id');
    }
    public function serviceHistoryCount(){
        return $this->serviceHistory()->count();
    }

    public function patientReports()
    {
        return $this->hasMany(PatientReport::class, 'patient_id', 'id');
    }

    public function patientPrescriptions()
    {
        return $this->hasMany(PatientPrescription::class, 'patient_id', 'id');
    }
}
