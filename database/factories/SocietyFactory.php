<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SocietyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 2,
            'owner_name' => $this->faker->text(5),
            'society_name' => $this->faker->text(5),
            'assign_id' => 3,
            'city_id' => 1,
            'province_id' => 1,
            'address' => 'Lahore, Pakistan',
            'society_type_id' => mt_rand(1, 2),
            'noc_type_id' => mt_rand(1, 3),
            'area' => 3000,
            'images_array' => '["Toyda6PBa21fFPcNbJVaGInu7jAIshwNfRUkVQBw.png"]',
            'details' => 'Testing',
            'status_id' => 3,
        ];
    }
}
