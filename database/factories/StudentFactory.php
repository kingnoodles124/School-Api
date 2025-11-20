<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'birthdate' => $this->faker->date('Y-m-d', '-10 years'),
            'grade' => $this->faker->randomElement(['1A', '2B', '3C', '4D', '5A']),
        ];
    }
}
