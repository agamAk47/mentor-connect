<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

/**
 * MentorshipRequest Model
 * 
 * Demonstrates:
 * - Eloquent Models (Unit VI)
 * - Mass Assignment Protection
 * - Relationships (belongsTo)
 */
class MentorshipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'startup_id',
        'mentor_id',
        'message',
        'status',
    ];

    /**
     * Get the startup that made the request.
     */
    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }

    /**
     * Get the mentor who received the request.
     */
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
}
