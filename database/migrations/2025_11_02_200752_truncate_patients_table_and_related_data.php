<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Delete all related data first (in reverse order of dependencies)
        DB::table('consultations')->truncate();
        DB::table('appointments')->truncate();
        DB::table('invoices')->truncate();
        DB::table('prescriptions')->truncate();
        DB::table('medical_records')->truncate();
        
        // Delete all patients
        DB::table('patients')->truncate();
        
        // Delete all patient users (users with role='patient')
        DB::table('users')->where('role', 'patient')->delete();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot reverse a truncate operation
        // Data would need to be restored from backups
    }
};
