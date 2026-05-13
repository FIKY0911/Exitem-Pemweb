<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([
            'name' => 'super-admin',
            'display_name' => 'Super Admin',
        ]);

        Role::firstOrCreate([
            'name' => 'admin',
            'display_name' => 'Admin',
        ]);

        Role::firstOrCreate([
            'name' => 'user',
            'display_name' => 'User',
        ]);
    }
}
