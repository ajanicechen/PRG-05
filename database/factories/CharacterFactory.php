<?php

namespace Database\Factories;

use App\Models\Character;
use App\Models\Vision;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'vision_id' => Vision::factory(),
            'lore'=> $this->faker->text(),
            'portrait'=> 'https://static.wikia.nocookie.net/gensin-impact/images/7/76/Character_Venti_Card.jpg'
        ];
    }
}
