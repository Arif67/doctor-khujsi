<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    use HasLocalizedAttributes;

      protected $table = "blogs";
    protected $fillable = [
        'title','category_id','short_description','content','status',
        'meta_title','meta_description','meta_keywords',
        'thumbnail_image','featured_image',
        'title_bn','short_description_bn','content_bn',
        'meta_title_bn','meta_description_bn','meta_keywords_bn',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getTitleAttribute($value): mixed
    {
        return $this->localizedValue('title', $value);
    }

    public function getShortDescriptionAttribute($value): mixed
    {
        return $this->localizedValue('short_description', $value);
    }

    public function getContentAttribute($value): mixed
    {
        return $this->localizedValue('content', $value);
    }

    public function getMetaTitleAttribute($value): mixed
    {
        return $this->localizedValue('meta_title', $value);
    }

    public function getMetaDescriptionAttribute($value): mixed
    {
        return $this->localizedValue('meta_description', $value);
    }

    public function getMetaKeywordsAttribute($value): mixed
    {
        return $this->localizedValue('meta_keywords', $value);
    }
}
