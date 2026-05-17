<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

/**
 * Admin Model
 *
 * Demonstrates:
 * - Eloquent ORM model for MongoDB (Unit VI)
 * - Admin authentication collection
 */
class Admin extends Model
{
    protected $collection = 'admins';

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password'];
}
