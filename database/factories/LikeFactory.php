<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Like;
use App\Models\User;
use App\Models\Resource;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
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

        $existingLikes = Like::select('user_id', 'resource_id')->get();

        $availableCombinations = $combinations->filter(function ($combination) use ($existingLikes) {
            $key = $combination[0] . '-' . $combination[1];
            return !$existingLikes->contains(function ($like) use ($combination) {
                return $like->github_id == $combination[0] && $like->resource_id == $combination[1];
            }) && !isset(static::$usedCombinations[$key]);
        });

        if ($availableCombinations->isEmpty()) {
            throw new \RuntimeException('No more unique combinations available for likes.');
        }

        $randomPair = $availableCombinations->random();
        $key = $randomPair[0] . '-' . $randomPair[1];
        static::$usedCombinations[$key] = true;

        return [
            'user_id' => $randomPair[0],
            'resource_id' => $randomPair[1],
        ];
    }
}
