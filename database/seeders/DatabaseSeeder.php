<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user
        $this->call(AdminUserSeeder::class);

        // Create default doctor
        $this->call(DefaultDoctorSeeder::class);

        // Create default users
        $this->createDefaultUsers();

        // Create sample data
        $this->createSampleData();
    }

    /**
     * Create default users.
     */
    private function createDefaultUsers(): void
    {
        // Note: Admin account is created by DefaultDoctorSeeder
        // No need to create additional doctor accounts here

    }

    /**
     * Create sample data.
     */
    private function createSampleData(): void
    {
        // Sample data creation removed - patient functionality deleted
    }
}
