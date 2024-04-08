<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->paragraph(),
            // 'filename' => fake()->randomElement(["1.mp4","2.mp4","3.mp4","4.mp4","5.mp4","6.mp4"]),
            'link' => fake()->url(),
            'course_id' => Course::all()->random()->id,
        ];
    }
}
