<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        $certificates = [
            ['name' => 'NASM Certified Personal Trainer', 'issuer' => 'National Academy of Sports Medicine'],
            ['name' => 'Precision Nutrition Level 1', 'issuer' => 'Precision Nutrition']
        ];

        foreach ($certificates as $certificate) {
            Certificate::create($certificate);
        }
    }
}