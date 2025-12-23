<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FAQ;

class FAQSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Is this suitable for absolute beginners?',
                'answer' => 'Absolutely! Every program is customized to your current fitness level. We start with the basics to ensure your form is perfect before progressing to more intense exercises.'
            ],
            [
                'question' => 'How does the Online Coaching work?',
                'answer' => 'Online coaching is delivered via our dedicated app. You will receive customized workout plans, nutrition goals, and have 24/7 access to chat with the coach. Weekly video check-ins ensure you stay on track.'
            ],
            [
                'question' => 'Do I need a gym membership for the home plans?',
                'answer' => 'Not necessarily. While a gym provides more equipment, we can design highly effective home-based programs using just dumbbells, resistance bands, or even just your body weight.'
            ],
            [
                'question' => 'Is nutrition coaching included in all plans?',
                'answer' => 'Nutrition guidance is included in our Pro Coaching and Elite Transformation plans. Starter plans focus primarily on training access and basic assessments.'
            ],
            [
                'question' => 'Can I cancel my subscription at any time?',
                'answer' => 'Yes, our plans are flexible. You can cancel or pause your subscription at any time through the member portal or by contacting support directly.'
            ]
        ];

        foreach ($faqs as $faq) {
            FAQ::create($faq);
        }
    }
}