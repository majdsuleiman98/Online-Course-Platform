<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Track;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title=fake()->paragraph();
        return [
            'title' => $title,
            'description' => fake()->paragraph(),
            'slug' => str_replace(" ","-",$title),
            //'status' => fake()->randomElement([0,1]),
            //'link' => fake()->url(),
            'price' => rand()/10000000,
            'track_id' => Track::all()->random()->id,
        ];
    }
}
