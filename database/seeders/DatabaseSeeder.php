<?php
declare (strict_types= 1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Frank Pulido',
            'email' => 'frankpulido@me.com',
            'password' => bcrypt('1234')
        ]);

        User::factory()->count(10)->create();

        $this->call([
            TagSeeder::class,
            ResourceSeeder::class,
            BookmarkSeeder::class,
            LikeSeeder::class,
            CommentSeeder::class
        ]);
    }
}
