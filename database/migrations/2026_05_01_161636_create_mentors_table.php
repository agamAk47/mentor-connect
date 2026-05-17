<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create Mentors Table
 *
 * Demonstrates:
 * - Migration with various column types (Unit VI)
 * - Foreign key relationship to categories table
 * - Default values and nullable columns
 * - Unique constraint on email
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // Mentor's full name
            $table->string('email')->unique();              // Unique email for login
            $table->string('password');                     // Password (hashed)
            $table->string('expertise');                    // Area of expertise
            $table->integer('experience')->default(0);      // Years of experience
            $table->text('bio')->nullable();                // Short profile bio
            $table->foreignId('category_id')               // FK to categories table
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('status')->default('approved');  // approved / pending / rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentors');
    }
};
