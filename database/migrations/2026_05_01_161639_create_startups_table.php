<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create Startups Table
 *
 * Demonstrates:
 * - Migration with text and string column types (Unit VI)
 * - Unique constraint on email
 * - Nullable fields
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('startups', function (Blueprint $table) {
            $table->id();
            $table->string('startup_name');                 // Name of the startup
            $table->string('founder_name');                 // Founder's full name
            $table->string('email')->unique();              // Unique email for login
            $table->string('password');                     // Password (hashed)
            $table->string('industry')->nullable();         // Industry/domain
            $table->string('stage')->nullable();            // Idea Stage, MVP, Growth, etc.
            $table->text('problem_statement')->nullable();  // What problem they're solving
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('startups');
    }
};
