<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Buat dua peran
        $roles = Role::factory()->count(2)->create();

        // Buat sepuluh pengguna dan kaitkan mereka dengan salah satu dari dua peran yang ada
        $users = User::factory()->count(10)->make()->each(function ($user) use ($roles) {
            $user->role_id = $roles->random()->id;
            $user->save();
        });

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
