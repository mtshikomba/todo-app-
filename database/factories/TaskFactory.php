<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->paragraph(1),
            'completed' => $this->faker->randomElement([0, 1]),
            'user_id' => User::all()->random(1)->first()->getKey()
        ];
    }
}
