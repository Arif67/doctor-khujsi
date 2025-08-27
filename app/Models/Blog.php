<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

      protected $table = "blogs";
    protected $fillable = [
        'title','category_id','short_description','text','status',
        'meta_title','meta_description','meta_keywords',
        'thumbnail_image','featured_image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
