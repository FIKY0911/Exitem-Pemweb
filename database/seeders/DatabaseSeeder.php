<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'display_name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'display_name' => 'User']);
        Role::firstOrCreate(['name' => 'super-admin', 'display_name' => 'Super Admin']);

        // Buat user admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            ['name' => 'Admin', 'password' => bcrypt('admin123')]
        );
        $admin->roles()->syncWithoutDetaching([$adminRole->id]);

        // Buat user biasa
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );
        $user->roles()->syncWithoutDetaching([$userRole->id]);
    }
}
