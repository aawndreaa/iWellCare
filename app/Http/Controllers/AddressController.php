<?php

namespace App\Http\Controllers;

use App\Models\PhilippineAddress;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Get all regions
     */
    public function getRegions()
    {
        $regions = PhilippineAddress::getRegions();
        return response()->json($regions);
    }

    /**
     * Get provinces by region
     */
    public function getProvinces(Request $request)
    {
        $regionCode = $request->query('region_code');
        if (!$regionCode) {
            return response()->json(['error' => 'Region code is required'], 400);
        }

        $provinces = PhilippineAddress::getProvincesByRegion($regionCode);
        return response()->json($provinces);
    }

    /**
     * Get municipalities by province
     */
    public function getMunicipalities(Request $request)
    {
        $provinceCode = $request->query('province_code');
        if (!$provinceCode) {
            return response()->json(['error' => 'Province code is required'], 400);
        }

        $municipalities = PhilippineAddress::getMunicipalitiesByProvince($provinceCode);
        return response()->json($municipalities);
    }

    /**
     * Get barangays by municipality
     */
    public function getBarangays(Request $request)
    {
        $municipalityCode = $request->query('municipality_code');
        if (!$municipalityCode) {
            return response()->json(['error' => 'Municipality code is required'], 400);
        }

        $barangays = PhilippineAddress::getBarangaysByMunicipality($municipalityCode);
        return response()->json($barangays);
    }
}
