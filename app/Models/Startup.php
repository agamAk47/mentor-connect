<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

/**
 * Startup Model
 *
 * Demonstrates:
 * - Eloquent ORM model (Unit VI)
 * - Mass assignment protection with $fillable
 * - Hidden attributes for security ($hidden)
 */
class Startup extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'startup_name',
        'founder_name',
        'email',
        'password',
        'industry',
        'stage',
        'problem_statement',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get all reviews written by this startup.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
