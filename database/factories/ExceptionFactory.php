<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExceptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exception::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'exception' => $this->faker->text(100),
        ];
    }
}
