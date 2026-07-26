<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password = null;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'patient',
        ];
    }


    /**
     * Utilisateur patient
     */
    public function patient(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'patient',
        ]);
    }


    /**
     * Utilisateur médecin
     */
    public function medecin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'medecin',
        ]);
    }


    /**
     * Utilisateur administrateur hôpital
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }


    /**
     * Super administrateur
     */
    public function superadmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'superadmin',
        ]);
    }


    /**
     * Indiquer que l'utilisateur n'a pas vérifié son email.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
