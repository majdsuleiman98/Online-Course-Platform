<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Course;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id=User::all()->random()->id;
        $course_id=Course::all()->random()->id;
        $photoable_id=fake()->randomElement([$user_id,$course_id]);
        $photoable_type=$photoable_id==$user_id?"App\User":"App\Course";
        return [
            'filename' => fake()->randomElement(["1.jpg","2.jpg","3.jpg","4.jpg","5.jpg","6.jpg"]),
            'photoable_id' => $photoable_id,
            'photoable_type' => Course::all()->random()->id,
        ];
    }
}
