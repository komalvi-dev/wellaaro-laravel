<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create all roles
        foreach (User::ROLES as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Super admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@wellaaro.com'],
            ['password' => Hash::make('password'), 'role' => 'super_admin', 'status' => 'active']
        );
        $superAdmin->assignRole('super_admin');
        $superAdmin->staffProfile()->updateOrCreate([], ['first_name' => 'Super', 'last_name' => 'Admin']);

        // Case manager
        $caseManager = User::firstOrCreate(
            ['email' => 'manager@wellaaro.com'],
            ['password' => Hash::make('password'), 'role' => 'case_manager', 'status' => 'active']
        );
        $caseManager->assignRole('case_manager');
        $caseManager->staffProfile()->updateOrCreate([], ['first_name' => 'Case', 'last_name' => 'Manager']);

        // Test patient
        $patient = User::firstOrCreate(
            ['email' => 'patient@wellaaro.com'],
            ['password' => Hash::make('password'), 'role' => 'patient', 'status' => 'active']
        );
        $patient->assignRole('patient');
        $patient->patientProfile()->updateOrCreate([], ['first_name' => 'Test', 'last_name' => 'Patient']);
    }
}
