<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LetterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = ['male', 'female'];

        return [
            'receiver' => fake()->name(),
            'situation' => Str::random('5'),
            'my_age' => fake()->numberBetween(0, 99),
            'my_gender' => $gender[rand(0, 1)],
            'friendly' => fake()->numberBetween(1, 5),
            'essential_comment' => Str::random('10'),
            'tone_content' => null,
            'generated_content' => fake()->sentence(20),
        ];
    }
}
