<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;
    use HasLocalizedAttributes;

    protected $table = "categories";
    protected $fillable = ['name', 'name_bn', 'description', 'description_bn', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }

    public function getNameAttribute($value): mixed
    {
        return $this->localizedValue('name', $value);
    }

    public function getDescriptionAttribute($value): mixed
    {
        return $this->localizedValue('description', $value);
    }
}
