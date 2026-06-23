<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Location;
use App\Models\VehicleType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed test user
        User::factory()->create([
            'name' => 'Sija Parking Admin',
            'email' => 'admin@sijaparking.com',
            'password' => Hash::make('password'),
        ]);

        // Seed Locations
        Location::create([
            'location_name' => 'Gedung A',
            'max_motorcycle' => 3,
            'max_car' => 0,
            'max_other' => 0,
        ]);

        Location::create([
            'location_name' => 'Gedung B',
            'max_motorcycle' => 3,
            'max_car' => 2,
            'max_other' => 0,
        ]);

        Location::create([
            'location_name' => 'Gedung C',
            'max_motorcycle' => 3,
            'max_car' => 3,
            'max_other' => 3,
        ]);

        // Seed Vehicle Types
        VehicleType::create([
            'jenis' => 'motorcycle',
            'perjam_pertama' => 2000,
            'perjam_berikutnya' => 1000,
            'max_perhari' => 10000,
        ]);

        VehicleType::create([
            'jenis' => 'car',
            'perjam_pertama' => 3000,
            'perjam_berikutnya' => 2000,
            'max_perhari' => 15000,
        ]);

        VehicleType::create([
            'jenis' => 'other',
            'perjam_pertama' => 5000,
            'perjam_berikutnya' => 3000,
            'max_perhari' => 30000,
        ]);
    }
}
