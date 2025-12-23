<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pricing;

class PricingSeeder extends Seeder
{
    public function run(): void
    {
        $pricing = [
            [
                'name' => 'Starter Plan',
                'price' => '350000',
                'period' => 'per month',
                'description' => 'Perfect for those just starting their fitness journey with full gym access.',
                'features' => json_encode(['Unlimited Gym Access', 'Locker & Shower Room', 'Free Fitness Assessment', 'Basic Workout Plan']),
                'popular' => false
            ],
            [
                'name' => 'Pro Coaching',
                'price' => '1200000',
                'period' => 'per month',
                'description' => 'Accelerate your results with dedicated 1-on-1 personal training sessions.',
                'features' => json_encode(['Everything in Starter', '8 Personal Training Sessions', 'Customized Nutrition Plan', 'Progress Tracking App']),
                'popular' => true
            ],
            [
                'name' => 'Elite Transformation',
                'price' => '3500000',
                'period' => 'per month',
                'description' => 'The ultimate package for total body transformation and 24/7 support.',
                'features' => json_encode(['Unlimited PT Sessions', 'Supplementation Guide', 'Monthly Body Scan (InBody)', '24/7 VIP Priority Support']),
                'popular' => false
            ]
        ];

        foreach ($pricing as $item) {
            Pricing::create($item);
        }
    }
}