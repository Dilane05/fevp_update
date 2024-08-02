<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'matricule' => strtoupper(Str::random(10)),
            'first_name' => ucwords(str_replace('_', ' ', fake()->firstNameFemale())),
            'last_name' => ucwords(str_replace('_', ' ', fake()->lastName())),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber,
            'gender' => fake()->randomElement(['male','female']),
            'date_of_birth' => fake()->date(),
            'emergency_contact_name' => fake()->name(),
            'emergency_contact_phone' => fake()->phoneNumber(),
            'occupation' => fake()->randomElement(['Farmer','Nurse','Business Woman','Entrepreneur','Teacher','Doctor']),
            'pemp_temp' => fake()->randomElement(['PEMP', 'TEMP']),
            'direction' => fake()->randomElement(['Direction 1', 'Direction 2']),
            'enterprise' => fake()->randomElement(['Enterprise 1', 'Enterprise 2']),
            'site' => fake()->randomElement(['Site 1', 'Site 2']),
            'signification_direction' => fake()->randomElement(['Signification 1', 'Signification 2']),
            'hiring_date' => fake()->date(),
            'statut_category' => fake()->randomElement(['Category 1', 'Category 2']),
            'email_verified_at' => now(),
            'status' => User::STATUS_ACTIVE,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
