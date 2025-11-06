<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class DoctorController extends Controller
{
    /**
     * Get all doctors.
     */
    public function index()
    {
        $doctors = User::where('role', 'doctor')
            ->with('doctor')
            ->select('id', 'first_name', 'last_name', 'email')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'specialization' => $user->doctor ? $user->doctor->specialization : null,
                ];
            });

        return response()->json($doctors);
    }

    /**
     * Get available doctors.
     */
    public function available()
    {
        $totalDoctors = User::whereIn('role', ['doctor', 'admin'])->count();

        // Get doctors with their availability status
        $doctors = User::whereIn('role', ['doctor', 'admin'])
            ->with(['doctor', 'availabilitySettings' => function($query) {
                $query->latest()->limit(1);
            }])
            ->select('id', 'first_name', 'last_name', 'email')
            ->get()
            ->map(function ($user) {
                $latestSetting = $user->availabilitySettings->first();
                $availabilityStatus = $latestSetting ? $latestSetting->getCurrentStatus() : ['is_available' => true, 'status' => 'available', 'message' => 'Available'];

                return [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'specialization' => $user->doctor ? $user->doctor->specialization : null,
                    'is_available' => $availabilityStatus['is_available'],
                    'status' => $availabilityStatus['status'],
                    'message' => $availabilityStatus['message'],
                ];
            });

        $availableDoctors = $doctors->where('is_available', true);

        // Return all doctors with their availability status, not just available ones
        return response()->json([
            'total' => $totalDoctors,
            'available' => $availableDoctors->count(),
            'doctors' => $doctors->values(),
        ]);
    }

    /**
     * Get a specific doctor.
     */
    public function show($id)
    {
        $doctor = User::where('role', 'doctor')
            ->where('id', $id)
            ->with('doctor')
            ->select('id', 'first_name', 'last_name', 'email', 'phone_number')
            ->first();

        if (! $doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        $response = [
            'id' => $doctor->id,
            'first_name' => $doctor->first_name,
            'last_name' => $doctor->last_name,
            'email' => $doctor->email,
            'phone' => $doctor->phone_number,
            'specialization' => $doctor->doctor ? $doctor->doctor->specialization : null,
        ];

        return response()->json($response);
    }
}
