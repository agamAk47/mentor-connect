<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mentor;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class MentorSeeder extends Seeder
{
    public function run(): void
    {
        // Get category IDs to assign randomly/specifically
        $techId = Category::where('name', 'Technology')->value('id');
        $marketingId = Category::where('name', 'Marketing')->value('id');
        $financeId = Category::where('name', 'Finance')->value('id');
        $designId = Category::where('name', 'Product Design')->value('id');

        $mentors = [
            [
                'name' => 'Dr. Vikram Sarabhai',
                'email' => 'vikram@example.com',
                'password' => Hash::make('password123'),
                'expertise' => 'Deep Tech & Space Technologies',
                'experience' => 15,
                'bio' => 'Former ISRO scientist with 15+ years of experience scaling deep tech startups. Specializes in hardware architecture and fundraising for R&D intensive projects.',
                'category_id' => $techId,
                'status' => 'approved',
            ],
            [
                'name' => 'Priya Sharma',
                'email' => 'priya@example.com',
                'password' => Hash::make('password123'),
                'expertise' => 'Growth Hacking & B2B SaaS',
                'experience' => 8,
                'bio' => 'Helped 3 SaaS startups reach $1M ARR. I can help you set up scalable inbound marketing funnels and refine your product positioning.',
                'category_id' => $marketingId,
                'status' => 'approved',
            ],
            [
                'name' => 'Rahul Desai',
                'email' => 'rahul@example.com',
                'password' => Hash::make('password123'),
                'expertise' => 'Venture Capital & Seed Funding',
                'experience' => 12,
                'bio' => 'Ex-VC partner. I guide early-stage startups on how to build their pitch decks, financial models, and navigate term sheets with investors.',
                'category_id' => $financeId,
                'status' => 'approved',
            ],
            [
                'name' => 'Aisha Gupta',
                'email' => 'aisha@example.com',
                'password' => Hash::make('password123'),
                'expertise' => 'UI/UX & User Psychology',
                'experience' => 6,
                'bio' => 'Lead Designer at a Fortune 500 tech firm. Passionate about helping startups build intuitive and emotionally resonant user interfaces.',
                'category_id' => $designId,
                'status' => 'approved',
            ],
            [
                'name' => 'Karan Singh',
                'email' => 'karan@example.com',
                'password' => Hash::make('password123'),
                'expertise' => 'AI/ML & Data Strategy',
                'experience' => 10,
                'bio' => 'Built machine learning pipelines for unicorns. I mentor technical founders on building robust AI architectures and scaling backend systems.',
                'category_id' => $techId,
                'status' => 'approved',
            ],
            [
                'name' => 'Meera Reddy',
                'email' => 'meera@example.com',
                'password' => Hash::make('password123'),
                'expertise' => 'Brand Storytelling',
                'experience' => 7,
                'bio' => 'Award-winning copywriter and brand strategist. I help founders articulate their vision and build compelling narratives that attract both users and talent.',
                'category_id' => $marketingId,
                'status' => 'approved',
            ],
        ];

        foreach ($mentors as $mentor) {
            Mentor::create($mentor);
        }
    }
}
