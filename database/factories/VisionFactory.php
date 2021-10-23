<?php

namespace Database\Factories;

use App\Models\Vision;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vision::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Anemo'
        ];
    }
}
