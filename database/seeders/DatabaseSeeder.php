<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SiteSettingSeeder::class,
            ServiceSeeder::class,
            PricingSeeder::class,
            FAQSeeder::class,
            TestimonialSeeder::class,
            LeaderboardSeeder::class,
            CertificateSeeder::class,
        ]);
    }
}