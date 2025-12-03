<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParishFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Paroisse ' . $this->faker->city,
            'city' => 'Kamina',
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude(-8.7, -8.8), // Coordonnées approx Kamina
            'longitude' => $this->faker->longitude(24.9, 25.0),
            'contact_phone' => $this->faker->phoneNumber,
            'mass_schedules' => [
                'Dimanche' => '07h00, 09h00, 17h00', 
                'Semaine' => '06h30'
            ],
        ];
    }
}