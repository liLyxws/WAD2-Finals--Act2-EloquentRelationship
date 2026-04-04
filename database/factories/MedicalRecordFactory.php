<?php

namespace Database\Factories;

use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MedicalRecord>
 */
class MedicalRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    return [
        'blood_type' => fake()->randomElement(['A+', 'B+', 'O+', 'AB-']),
        'allergies' => fake()->sentence(),
        'chronic_conditions' => fake()->sentence(),
    ];
    }
}
