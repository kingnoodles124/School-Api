<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolClassFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Math', 'Science', 'English', 'History', 'Geography']),
            'section' => strtoupper($this->faker->randomLetter),
            'max_students' => $this->faker->numberBetween(1, 30),
        ];
    }
}
