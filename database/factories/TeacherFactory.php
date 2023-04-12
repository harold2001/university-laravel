<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create()->assignRole('maestro');
        
        return [
            "user_id" => $user->id,
            "name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "phone" => fake()->e164PhoneNumber(),
        ];
    }
}
