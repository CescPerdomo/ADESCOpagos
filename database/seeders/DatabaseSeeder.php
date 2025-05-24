<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
        ]);
        $admin->roles()->attach(1); // Attach admin role

        // Create regular user
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
        ]);
        $user->roles()->attach(2); // Attach user role
    }
}
