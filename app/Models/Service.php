<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasLocalizedAttributes;

    protected $table = 'services';
    protected $fillable = ['owner_id', 'image', 'title', 'description', 'title_bn', 'description_bn'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function getTitleAttribute($value): mixed
    {
        return $this->localizedValue('title', $value);
    }

    public function getDescriptionAttribute($value): mixed
    {
        return $this->localizedValue('description', $value);
    }
}
