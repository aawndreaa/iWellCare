<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilippineAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_code',
        'region_name',
        'province_code',
        'province_name',
        'municipality_code',
        'municipality_name',
        'barangay_code',
        'barangay_name',
        'zip_code',
    ];

    // Get unique regions
    public static function getRegions()
    {
        return static::select('region_code', 'region_name')
            ->whereNotNull('region_code')
            ->distinct()
            ->orderBy('region_name')
            ->get();
    }

    // Get provinces by region
    public static function getProvincesByRegion($regionCode)
    {
        return static::select('province_code', 'province_name')
            ->where('region_code', $regionCode)
            ->whereNotNull('province_code')
            ->distinct()
            ->orderBy('province_name')
            ->get();
    }

    // Get municipalities by province
    public static function getMunicipalitiesByProvince($provinceCode)
    {
        return static::select('municipality_code', 'municipality_name')
            ->where('province_code', $provinceCode)
            ->whereNotNull('municipality_code')
            ->distinct()
            ->orderBy('municipality_name')
            ->get();
    }

    // Get barangays by municipality
    public static function getBarangaysByMunicipality($municipalityCode)
    {
        return static::select('barangay_code', 'barangay_name')
            ->where('municipality_code', $municipalityCode)
            ->whereNotNull('barangay_code')
            ->distinct()
            ->orderBy('barangay_name')
            ->get();
    }
}
