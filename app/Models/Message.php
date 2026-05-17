<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'sender_type',
        'receiver_id',
        'receiver_type',
        'content',
        'read_at',
    ];

    /**
     * Get the sender of the message.
     */
    public function sender()
    {
        if ($this->sender_type === 'startup') {
            return $this->belongsTo(Startup::class, 'sender_id');
        }
        return $this->belongsTo(Mentor::class, 'sender_id');
    }

    /**
     * Get the receiver of the message.
     */
    public function receiver()
    {
        if ($this->receiver_type === 'startup') {
            return $this->belongsTo(Startup::class, 'receiver_id');
        }
        return $this->belongsTo(Mentor::class, 'receiver_id');
    }
}
