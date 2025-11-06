<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('philippine_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('region_code', 10)->nullable();
            $table->string('region_name')->nullable();
            $table->string('province_code', 10)->nullable();
            $table->string('province_name')->nullable();
            $table->string('municipality_code', 10)->nullable();
            $table->string('municipality_name')->nullable();
            $table->string('barangay_code', 10)->nullable();
            $table->string('barangay_name')->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->timestamps();

            // Indexes for performance
            $table->index(['region_code']);
            $table->index(['province_code']);
            $table->index(['municipality_code']);
            $table->index(['barangay_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('philippine_addresses');
    }
};
