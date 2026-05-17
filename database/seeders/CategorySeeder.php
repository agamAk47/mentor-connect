<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

/**
 * CategorySeeder
 *
 * Demonstrates:
 * - Database seeding (Unit VI)
 * - Eloquent create() method for inserting records
 * - Using Artisan command: php artisan db:seed --class=CategorySeeder
 */
class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'icon' => 'code-2'],
            ['name' => 'Marketing', 'icon' => 'megaphone'],
            ['name' => 'Finance', 'icon' => 'indian-rupee'],
            ['name' => 'Product Design', 'icon' => 'palette'],
            ['name' => 'Operations', 'icon' => 'settings'],
            ['name' => 'Legal', 'icon' => 'scale'],
            ['name' => 'Sales', 'icon' => 'bar-chart-3'],
            ['name' => 'HR & Culture', 'icon' => 'heart'],
        ];

        foreach ($categories as $category) {
            // Using Eloquent ORM create() - Unit VI
            Category::create($category);
        }
    }
}
