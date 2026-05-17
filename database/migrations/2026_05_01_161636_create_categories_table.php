<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create Categories Table
 *
 * Demonstrates:
 * - Migration creation using Artisan (Unit I)
 * - Database schema definition (Unit VI)
 * - Timestamps for record tracking
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // Category name (e.g., Technology, Marketing)
            $table->string('icon')->nullable(); // Icon name for UI display
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
