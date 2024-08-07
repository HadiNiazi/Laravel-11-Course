<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::first();

        return [
            'user_id' => $user->id,
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'status' => fake()->boolean,
            'image' => 'test.png',
        ];
    }
}
