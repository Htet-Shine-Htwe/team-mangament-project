<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Issue>
 */
class IssueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(3),
            'status_id' => Status::inRandomOrder()->first()->id,
            'creator_id' => $this->faker->numberBetween(1, 10),
            'assign_id' => $this->faker->numberBetween(1, 10),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 years'),
            'workspace_id' => 6001,
        ];
    }
}
