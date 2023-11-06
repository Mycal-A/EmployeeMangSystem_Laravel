<?php

namespace Database\Factories;
use App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmpFamily>
 */
class EmpFamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' =>Employee::factory(),
            'name' => $this->faker->name,
            'relationship' => $this->faker->word,
            'dob' => $this->faker->date,
        ];
    }
}
