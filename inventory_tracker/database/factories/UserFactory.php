<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'employee',
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
        ];
    }

    public function admin()
    {
       return $this->state(function (array $attributes) {
           return [
               'role' => 'admin',
           ];
       }); 
    }

    public function manager()
    {
        return $this->state(function (array $attributes){
            return [
                'role' => 'manager',
            ];
        });
    }

    public function employee()
    {
       return $this->state(function (array $attributes) {
           return [
               'role' => 'employee',
           ];
       }); 
    }
}
