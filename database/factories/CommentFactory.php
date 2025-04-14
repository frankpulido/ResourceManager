<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\User;
use App\Models\Resource;

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
    
     protected static $usedCombinations = [];

     public function definition(): array
    {
        $students = User::pluck('id');
        $resources = Resource::pluck('id');
        $combinations = $students->crossJoin($resources);

        $existingComments = Comment::select('user_id', 'resource_id')->get();

        $availableCombinations = $combinations->filter(function ($combination) use ($existingComments) {
            $key = $combination[0] . '-' . $combination[1];
            return !$existingComments->contains(function ($like) use ($combination) {
                return $like->github_id == $combination[0] && $like->resource_id == $combination[1];
            }) && !isset(static::$usedCombinations[$key]);
        });

        if ($availableCombinations->isEmpty()) {
            throw new \RuntimeException('No more unique combinations available for comments.');
        }

        $randomPair = $availableCombinations->random();
        $key = $randomPair[0] . '-' . $randomPair[1];
        static::$usedCombinations[$key] = true;

        return [
            'user_id' => $randomPair[0],
            'resource_id' => $randomPair[1],
            'comment' => $this->faker->text(),
        ];
    }
}
