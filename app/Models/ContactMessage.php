<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $table = 'contact_messages';
    protected $fillable = [
        'user_id',
        'handled_by_id',
        'name',
        'email',
        'subject',
        'type',
        'priority',
        'status',
        'message',
        'admin_reply',
        'replied_at',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function handledBy()
    {
        return $this->belongsTo(User::class, 'handled_by_id');
    }
}
