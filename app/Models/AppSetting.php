<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;

    protected $table = 'app_settings';
    protected $fillable = ['phone','mail','location','logo','description','social'];

    protected $casts = [
        'phone' => 'array',
        'mail' => 'array',
        'location' => 'array',
        'logo' => 'array',
        'social' => 'array',
    ];
}
