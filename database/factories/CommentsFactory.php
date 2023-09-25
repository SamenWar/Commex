<?php

namespace Database\Factories;

use App\Models\Comments;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comments::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_name' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'home_page' => $this->faker->optional()->url,
            'text' => $this->faker->paragraph,
            'parent_id' => null // По умолчанию у комментария нет родителя. Вы можете модифицировать это поведение при необходимости.
        ];
    }
}
