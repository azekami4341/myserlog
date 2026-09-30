<?php

namespace Database\Factories;

use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'brand' => fake()->randomElement([
                'Yamaha',
                'Honda',
                'Suzuki',
                'Toyota',
                'Mitsubishi',
                'BMW',
            ]),
            'model' => fake()->word(),
            'year' => fake()->numberBetween(2000, 2026),
            'licence_plate' => fake()->bothify('K #### ??'),
            'initial_odometer' => fake()->randomFloat(1, 0, 299999),
        ];
    }
}