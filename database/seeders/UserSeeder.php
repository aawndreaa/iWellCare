<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the main doctor - Dr. Augustus Caesar Butch B. Bigornia
        User::create([
            'first_name' => 'Dr. Augustus Caesar Butch B.',
            'last_name' => 'Bigornia',
            'full_name' => 'Dr. Augustus Caesar Butch B. Bigornia',
            'username' => 'doctor',
            'email' => 'doctor@iwellcare.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'doctor',
            'phone_number' => '+1234567890',
            'street_address' => '123 Medical Center Dr',
            'city' => 'Healthcare City',
            'is_active' => true,
        ]);




        // Create a sample patient
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'full_name' => 'John Doe',
            'username' => 'patient',
            'email' => 'patient@iwellcare.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'patient',
            'phone_number' => '+1234567895',
            'street_address' => '789 Patient Ave',
            'city' => 'Patient City',
            'is_active' => true,
        ]);

    }
}
