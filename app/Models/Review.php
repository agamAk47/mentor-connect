<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

/**
 * Review Model
 *
 * Demonstrates:
 * - Eloquent ORM relationships (BelongsTo)
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'startup_id',
        'rating',
        'review_text',
    ];

    /**
     * Get the mentor that was reviewed.
     */
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    /**
     * Get the startup that wrote the review.
     */
    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }
}
