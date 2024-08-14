<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Site;
use App\Models\User;
use App\Models\Direction;
use App\Models\Enterprise;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\SitesTableSeeder;
use Database\Seeders\TypeFichierSeeder;
use Database\Seeders\DirectionsTableSeeder;
use Database\Seeders\EnterprisesTableSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Database\Seeders\AssignTypeFichierToUsersSeeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RolesAndPermissionsSeeder::class);

        $this->call(DirectionsTableSeeder::class);

        $this->call(EnterprisesTableSeeder::class);

        $this->call(TypeFichierSeeder::class);

        // $this->call(AssignTypeFichierToUsersSeeder::class);

        $this->call(SitesTableSeeder::class);

        // Crée 50 utilisateurs et leur assigne le rôle 'user'
        // User::factory(50)->create(50)->each(function ($user) {
        //     $user->assignRole('user'); // Assigne un rôle 'user' aux utilisateurs
        // });

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
