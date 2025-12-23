<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixFeaturesJsonSeeder extends Seeder
{
    public function run()
    {
        // Fix Services
        $services = DB::table('services')->get();
        foreach ($services as $service) {
            if (is_string($service->features)) {
                DB::table('services')
                    ->where('id', $service->id)
                    ->update([
                        'features' => json_decode($service->features)
                    ]);
            }
        }

        // Fix Pricing
        $pricings = DB::table('pricing')->get();
        foreach ($pricings as $pricing) {
            if (is_string($pricing->features)) {
                DB::table('pricing')
                    ->where('id', $pricing->id)
                    ->update([
                        'features' => json_decode($pricing->features)
                    ]);
            }
        }

        $this->command->info('✅ Features fixed successfully!');
    }
}