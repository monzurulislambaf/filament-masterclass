<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Treatment;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    public function run(): void
    {
        $treatments = [
            ['description' => 'Annual Checkup', 'price' => 5000],
            ['description' => 'Vaccination', 'price' => 7500],
            ['description' => 'Dental Cleaning', 'price' => 15000],
            ['description' => 'Spay/Neuter Surgery', 'price' => 25000],
            ['description' => 'Emergency Visit', 'price' => 20000],
        ];

        Patient::all()->each(function ($patient) use ($treatments) {
            $numTreatments = rand(1, 4);
            
            for ($i = 0; $i < $numTreatments; $i++) {
                $treatment = $treatments[array_rand($treatments)];
                
                Treatment::create([
                    'patient_id' => $patient->id,
                    'description' => $treatment['description'],
                    'price' => $treatment['price'],
                    'notes' => fake()->paragraph(),
                    'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
                ]);
            }
        });
    }
}