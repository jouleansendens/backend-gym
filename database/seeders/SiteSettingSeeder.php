<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            "hero.badge" => "Certified Personal Trainer",
            "hero.title" => "Transform Your Body,\nTransform Your Life",
            "hero.subtitle" => "Achieve your fitness goals with personalized 1-on-1 coaching, customized workout plans, and expert guidance - both in-person and online.",
            "hero.cta_primary" => "Start Your Journey",
            "hero.cta_secondary" => "Watch Video",
            "hero.stat1_value" => "500+",
            "hero.stat1_label" => "Clients Trained",
            "hero.stat2_value" => "10+",
            "hero.stat2_label" => "Years Experience",
            "hero.stat3_value" => "98%",
            "hero.stat3_label" => "Success Rate",
            "about.label" => "About Me",
            "about.title" => "Your Partner in\nFitness Excellence",
            "about.desc1" => "With over 10 years of experience in personal training and fitness coaching, I've helped hundreds of clients achieve their fitness goals.",
            "about.desc2" => "My approach combines proven training methodologies with personalized attention to ensure you not only reach your goals but maintain them for life.",
            "about.button" => "Learn More About Me",
            "about.modal_title" => "My Fitness Journey",
            "about.modal_content" => "With over 10 years of experience, I started this journey because I believe everyone deserves to feel strong and confident in their own skin...",
            "about.modal_button" => "Close Story",
            "coach.label" => "Meet Your Coach",
            "coach.title" => "Your Partner in Fitness Excellence",
            "coach.desc1" => "With over 10 years of experience in personal training, I help people transform their lives through sustainable fitness.",
            "coach.desc2" => "My approach focuses on functional movement and nutrition tailored to your lifestyle.",
            "coach.cert1.title" => "NASM",
            "coach.cert1.desc" => "Certified Personal Trainer",
            "coach.cert2.title" => "PN1",
            "coach.cert2.desc" => "Nutrition Coach",
            "coach.link" => "Read My Full Story",
            "contact.phone" => "6281234567890",
            "contact.wa_template" => "Halo Coach, saya tertarik daftar paket *{name}* dengan harga {price}/{period}. Mohon infonya.",
            "contact.hours.mon_fri" => "6:00 AM - 10:00 PM",
            "contact.hours.sat" => "8:00 AM - 8:00 PM",
            "contact.hours.sun" => "9:00 AM - 6:00 PM",
            "social.instagram" => "https://instagram.com",
            "social.facebook" => "https://facebook.com",
            "social.youtube" => "https://youtube.com",
            "social.linkedin" => "",
            "social.twitter" => "",
            "site.name" => "FITCOACH",
            "quote.text" => "The only bad workout is the one that didn't happen.",
            "quote.font" => '"Playfair Display", serif',
            "quote.author" => "— COACH FITCOACH",
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}