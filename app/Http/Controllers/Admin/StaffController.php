<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StaffProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $staff = User::caseManagers()->with('staffProfile')->orderBy('email')->paginate(25);
        return view('admin.staff.index', compact('staff'));
    }

    public function create() { return view('admin.staff.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8|confirmed',
            'role'       => 'required|in:case_manager,admin,hospital_admin',
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'department' => 'nullable|string|max:100',
            'phone'      => 'nullable|string|max:30',
        ]);
        $user = User::create([
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
        ]);
        $user->staffProfile()->create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'department' => $data['department'] ?? null,
            'phone'      => $data['phone'] ?? null,
        ]);
        return redirect()->route('admin.staff.index')->with('success', 'Staff member created.');
    }

    public function show(User $staff) { return view('admin.staff.show', compact('staff')); }

    public function edit(User $staff) { return view('admin.staff.edit', compact('staff')); }

    public function update(Request $request, User $staff)
    {
        $request->validate([
            'email'      => 'required|email|unique:users,email,' . $staff->id,
            'role'       => 'required|in:case_manager,admin,hospital_admin',
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
        ]);
        $staff->update(['email' => $request->email, 'role' => $request->role]);
        $staff->staffProfile()->updateOrCreate(['user_id' => $staff->id], [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'department' => $request->department,
            'phone'      => $request->phone,
        ]);
        return redirect()->route('admin.staff.index')->with('success', 'Staff updated.');
    }

    public function destroy(User $staff)
    {
        $staff->update(['status' => 'suspended']);
        return redirect()->route('admin.staff.index')->with('success', 'Staff member suspended.');
    }
}
