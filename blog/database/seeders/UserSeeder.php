<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Blog;
use App\Models\User;
use Database\Factories\ImageFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)
            ->has(
                Blog::factory()->count(10)
                ->has(ImageFactory::new()->count(5), 'images')
                ->afterCreating(function ($blog) {
                    $blog->images->first()->pivot->is_featured = 1;
                    $blog->images->first()->pivot->save();
                })
            )
            ->has(Address::factory()->count(2))
            ->create();
    }
}
