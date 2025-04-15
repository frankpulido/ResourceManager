<?php
declare (strict_types= 1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'unitary-testing',
            'tdd',
            'oop',
            'debugging',
            'rendering',
            'styling-css',
            'hooks',
            'components',
            'fragments',
            'props',
            'lists-keys',
            'modules',
            'events',
            'dependencies',
            'mongodb',
            'postgresql',
            'firebase',
            'aws',
            'azure',
            'vercel',
            'github'
        ];
        
        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
            ]);
        }
    }
}
