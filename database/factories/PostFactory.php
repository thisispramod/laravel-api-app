<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
    
    protected $model = \App\Models\Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence();

        return [
            'title' => $title,
            'body' => $this->faker->paragraph(5),
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'meta_title' => $title,
            'meta_description' => $this->faker->sentence(),
            'status' => 'draft',
        ];
    }
}
