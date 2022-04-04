<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Frontliner>
 */
class FrontlinerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'generation_id' => mt_rand(1,1),
            'name' => $this->faker->name(),
            'jobdesk' => $this->faker->sentence(mt_rand(2, 3)),
            'slug' => $this->faker->slug(),
            'bio' => $this->faker->paragraph(),
            'email' => $this->faker->unique()->safeEmail(),
            'linkedin' => $this->faker->sentence(mt_rand(2, 10)),
            'instagram' => $this->faker->sentence(mt_rand(2, 10)),
            'facebook' => $this->faker->sentence(mt_rand(2, 10)),
            'twitter' => $this->faker->sentence(mt_rand(2, 10)),
            'website' => $this->faker->sentence(mt_rand(2, 10)),
        ];
    }
}
