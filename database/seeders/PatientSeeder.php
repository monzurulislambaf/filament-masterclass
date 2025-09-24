<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $petTypes = ['Dog', 'Cat', 'Bird', 'Rabbit', 'Hamster'];
        
        Owner::all()->each(function ($owner) use ($petTypes) {
            $numPets = rand(1, 3);
            
            for ($i = 0; $i < $numPets; $i++) {
                Patient::create([
                    'owner_id' => $owner->id,
                    'name' => fake()->firstName(),
                    'type' => $petTypes[array_rand($petTypes)],
                    'date_of_birth' => fake()->dateTimeBetween('-10 years', '-1 month'),
                ]);
            }
        });
    }
}