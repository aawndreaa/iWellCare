<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class StaffController extends Controller
{
    /**
     * Display a listing of staff members.
     */
    public function index()
    {
        $query = User::where('role', 'staff');

        // Apply filters
        if (request('filter') === 'active') {
            $query->where('is_active', true);
        } elseif (request('filter') === 'inactive') {
            $query->where('is_active', false);
        } elseif (request('filter') === 'archived') {
            $query->onlyTrashed(); // This will show soft deleted records
        }

        $staff = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get counts for display
        $activeCount = User::where('role', 'staff')->where('is_active', true)->count();
        $inactiveCount = User::where('role', 'staff')->where('is_active', false)->count();
        $archivedCount = User::where('role', 'staff')->onlyTrashed()->count();

        return view('admin.staff.index', compact('staff', 'activeCount', 'inactiveCount', 'archivedCount'));
    }

    /**
     * Show the form for creating a new staff member.
     */
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store a newly created staff member.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:20',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state_province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'password' => ['required', 'confirmed', Password::defaults()],
            'is_active' => 'boolean',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'full_name' => trim($request->first_name . ' ' . $request->last_name),
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state_province' => $request->state_province,
            'postal_code' => $request->postal_code,
            'password' => Hash::make($request->password),
            'role' => 'staff',
            'is_active' => $request->boolean('is_active', true),
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff member created successfully.');
    }

    /**
     * Display the specified staff member.
     */
    public function show(User $staff)
    {
        return view('admin.staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified staff member.
     */
    public function edit(User $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    /**
     * Update the specified staff member.
     */
    public function update(Request $request, User $staff)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => "required|string|max:255|unique:users,username,{$staff->id}",
            'email' => "required|string|email|max:255|unique:users,email,{$staff->id}",
            'phone_number' => 'required|string|max:20',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state_province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'is_active' => 'boolean',
        ]);

        $staff->update($request->only([
            'first_name', 'last_name', 'username', 'email', 'phone_number',
            'street_address', 'city', 'state_province', 'postal_code', 'is_active',
        ]));

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff member updated successfully.');
    }

    /**
     * Remove the specified staff member.
     */
    public function destroy(User $staff)
    {
        $staff->delete(); // This will soft delete

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff member archived successfully.');
    }

    /**
     * Toggle staff member status.
     */
    public function toggleStatus(User $staff)
    {
        $staff->update(['is_active' => ! $staff->is_active]);

        $status = $staff->is_active ? 'activated' : 'deactivated';

        return redirect()->route('admin.staff.index')
            ->with('success', "Staff member {$status} successfully.");
    }

    /**
     * Restore a soft deleted staff member.
     */
    public function restore($id)
    {
        $staff = User::withTrashed()->findOrFail($id);
        $staff->restore();

        return redirect()->route('admin.staff.index', ['filter' => 'archived'])
            ->with('success', 'Staff member restored successfully.');
    }
}
