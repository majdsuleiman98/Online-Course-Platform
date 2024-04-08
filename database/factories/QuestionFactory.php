<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Quiz;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $answers=fake()->paragraph(4);
        $right_answer=fake()->randomElement(explode(" ",$answers));
        return [
            'title' => fake()->name(),
            'answers' => $answers,
            'right_answer' => $right_answer,
            'score' => fake()->randomElement([5,10,15,20]),
            'quiz_id' => Quiz::all()->random()->id,
        ];
    }
}
