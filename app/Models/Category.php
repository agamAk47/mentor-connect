<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

/**
 * Category Model
 *
 * Demonstrates:
 * - Eloquent ORM model (Unit VI)
 * - Mass assignment protection with $fillable
 * - One-to-Many relationship (Category has many Mentors)
 */
class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     * Required for Eloquent create() and update() methods.
     */
    protected $fillable = [
        'name',
        'icon',
    ];

    /**
     * Get all mentors belonging to this category.
     * Demonstrates Eloquent relationship (Unit VI)
     */
    public function mentors()
    {
        return $this->hasMany(Mentor::class);
    }
}
