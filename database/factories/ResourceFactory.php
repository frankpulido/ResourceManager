<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $validTags = Tag::all()->pluck('name')->toArray();

        return [
            'user_id' => $user->id,
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(10),
            'url' => $this->faker->url(),
            'category' => $this->faker->randomElement(['Node', 'React', 'Angular', 'JavaScript', 'Java', 'Fullstack PHP', 'Data Science', 'BBDD']),
            'tags' => $this->faker->randomElements($validTags, $this->faker->numberBetween(1, 5)),
            'type' => $this->faker->randomElement(['Video', 'Cursos', 'Blog']),
        ];
    }
}
