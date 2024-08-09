<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'uuid' => (string) Str::uuid(),
            'matricule' => $this->faker->unique()->word,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'name' => $this->faker->name,
            'occupation' => $this->faker->jobTitle,
            'pemp_temp' => $this->faker->word,
            'main_evaluator' => User::factory(), // Remplace par une relation si nécessaire
            'second_evaluator' => User::factory(), // Remplace par une relation si nécessaire
            'direction_id' => \App\Models\Direction::factory(),
            'enterprise_id' => \App\Models\Enterprise::factory(),
            'site_id' => \App\Models\Site::factory(),
            'hiring_date' => $this->faker->date,
            'length_of_service' => $this->faker->numberBetween(1, 10),
            'statut_category' => $this->faker->word,
            'responsable_n1' => User::factory(),
            'responsable_n2' => User::factory(),
            'date_of_birth' => $this->faker->date,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'emergency_contact_name' => $this->faker->name,
            'emergency_contact_phone' => $this->faker->phoneNumber,
            'email_verified_at' => now(),
            'status' => \App\Models\User::STATUS_ACTIVE,
            'password' => Hash::make('password'), // Utiliser un mot de passe sécurisé
        ];
    }
}
