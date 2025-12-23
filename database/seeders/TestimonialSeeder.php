<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Michael Chen',
                'role' => 'Software Engineer',
                'image' => 'https://i.pravatar.cc/150?img=12',
                'rating' => 5,
                'text' => 'Best decision I ever made! I lost 30 pounds in 4 months and gained so much confidence. The personalized coaching made all the difference.',
                'is_active' => true
            ],
            [
                'name' => 'Sarah Jenkins',
                'role' => 'Marketing Director',
                'image' => 'https://i.pravatar.cc/150?img=32',
                'rating' => 5,
                'text' => 'The online coaching is perfect for my busy schedule. Professional, knowledgeable, and always there to support me. Highly recommend!',
                'is_active' => true
            ],
            [
                'name' => 'David Rodriguez',
                'role' => 'Business Owner',
                'image' => 'https://i.pravatar.cc/150?img=13',
                'rating' => 5,
                'text' => 'Transformed my body and mindset in just 3 months. The workouts are challenging but achievable, and the results speak for themselves.',
                'is_active' => true
            ],
            [
                'name' => 'James Thompson',
                'role' => 'Accountant',
                'image' => 'https://i.pravatar.cc/150?img=14',
                'rating' => 5,
                'text' => 'The 1-on-1 sessions are worth every penny. Finally achieved the physique I always wanted. Expert guidance at its best.',
                'is_active' => true
            ],
            [
                'name' => 'Elena Vance',
                'role' => 'Graphic Designer',
                'image' => 'https://i.pravatar.cc/150?img=44',
                'rating' => 5,
                'text' => 'Started as a complete beginner and now I feel like an athlete. Great coaching, great programs, and truly great results!',
                'is_active' => true
            ],
            [
                'name' => 'Marcus Thorne',
                'role' => 'Project Manager',
                'image' => 'https://i.pravatar.cc/150?img=68',
                'rating' => 5,
                'text' => 'Excellent trainer who really cares about his clients. The custom meal plans and workout routines were exactly what I needed.',
                'is_active' => true
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}