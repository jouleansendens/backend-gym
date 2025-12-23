<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => '1-on-1 Personal Training',
                'description' => 'Highly personalized sessions focused on your specific goals, form, and rapid progress.',
                'icon_name' => 'User',
                'features' => json_encode(['Customized workout plans', 'Posture & form correction', 'Private training environment'])
            ],
            [
                'title' => 'Online Coaching',
                'description' => 'Train from anywhere in the world with expert guidance delivered straight to your smartphone.',
                'icon_name' => 'Video',
                'features' => json_encode(['Mobile app integration', 'Weekly video check-ins', '24/7 Chat support'])
            ],
            [
                'title' => 'Competition Prep',
                'description' => 'Specialized programming for athletes looking to step on stage or compete at elite levels.',
                'icon_name' => 'Activity',
                'features' => json_encode(['Peak week protocols', 'Posing coaching', 'Performance analysis'])
            ],
            [
                'title' => 'Nutrition Planning',
                'description' => 'Fuel your body correctly with science-based meal plans tailored to your metabolism.',
                'icon_name' => 'Heart',
                'features' => json_encode(['Macro-nutrient breakdown', 'Supplement guidance', 'Grocery shopping lists'])
            ],
            [
                'title' => 'Small Group Sessions',
                'description' => 'The perfect balance of professional coaching and high-energy community motivation.',
                'icon_name' => 'Users',
                'features' => json_encode(['Max 5 people per group', 'Accountability partners', 'Budget-friendly rates'])
            ],
            [
                'title' => 'Express HIIT',
                'description' => 'High-intensity interval training designed to burn maximum calories in just 30 minutes.',
                'icon_name' => 'Zap',
                'features' => json_encode(['Metabolic conditioning', 'Rapid fat loss', 'Equipment-free options'])
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}