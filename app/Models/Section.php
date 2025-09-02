<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table = "sections";
    protected $fillable = ['page_id', 'key', 'data', 'order'];
    protected $casts = [
        'data' => 'array', // json ফিল্ডকে array আকারে ব্যবহার করতে পারবেন
    ];
}
