<?php

namespace Database\Seeders;

use App\Models\Owner;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    public function run(): void
    {
        Owner::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '(555) 123-4567',
        ]);

        Owner::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '(555) 987-6543',
        ]);

        Owner::factory(8)->create();
    }
}