<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesAndPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RolesAndPermissionsSeeder::class);

        User::factory()
        ->count(2)
        ->create()
        ->each(function ($user) {
            $user->assignRole('user');
        });

        \App\Models\User::create(['uuid' => Str::uuid(),
            'matricule' => 'super001',
            'first_name' => ucwords(str_replace('_', ' ', fake()->name())),
            'last_name' => ucwords(str_replace('_', ' ', fake()->name())),
            'email' => 'admin@fevp.cadyst',
            'gender' => fake()->randomElement(['male', 'female']),
            'phone_number' => fake()->phoneNumber,
            'occupation' => 'System Administrator',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('admin');

        // $this->call(WorldSeeder::class);
    }
}
