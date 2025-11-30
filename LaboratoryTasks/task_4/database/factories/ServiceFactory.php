<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        $received = $this->faker->dateTimeBetween('-30 days', 'now');
        $finished = $this->faker->boolean(70) ? $this->faker->dateTimeBetween($received, 'now') : null;

        return [
            'mechanic_first_name' => $this->faker->firstName(),
            'mechanic_last_name' => $this->faker->lastName(),
            'client_first_name' => $this->faker->firstName(),
            'client_last_name' => $this->faker->lastName(),
            'brand' => $this->faker->randomElement(['Toyota','Volkswagen','BMW','Audi','Mercedes','Opel']),
            'model' => strtoupper($this->faker->bothify('???-###')),
            'licence_number' => strtoupper($this->faker->bothify('??-####-??')),
            'description' => $this->faker->sentence(8),
            'price' => $this->faker->randomFloat(2, 500, 10000),
            'received_at' => $received->format('Y-m-d'),
            'finished_at' => $finished ? $finished->format('Y-m-d') : null,
        ];
    }
}

