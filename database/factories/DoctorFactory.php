<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => 'Dr. ' . fake()->name(),
            'specialization' => fake()->randomElement([
                'Cardiologist', 
                'Pediatrician', 
                'Dermatologist', 
                'Neurologist', 
                'General Surgeon'
            
            ]),
            'license_number' => fake()->unique()->numerify('PRC-#######'),
        ];
    }
}