<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

/**
 * Mentor Model
 *
 * Demonstrates:
 * - Eloquent ORM model (Unit VI)
 * - Mass assignment protection with $fillable
 * - Hidden attributes for security ($hidden)
 * - BelongsTo relationship (Mentor belongs to Category)
 */
class Mentor extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'expertise',
        'experience',
        'bio',
        'category_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Password is hidden when model is converted to array/JSON.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the category this mentor belongs to.
     * Demonstrates Eloquent BelongsTo relationship (Unit VI)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all reviews for this mentor.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
