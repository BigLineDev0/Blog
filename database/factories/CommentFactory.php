<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $create_at = fake()->dateTimeBetween('-1 year');

        return [
            'content' => fake()->unique()->sentence,
            'created_at' => $create_at,
            'updated_at' => $create_at,
        ];
    }
}
