<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmpExperience>
 */
class EmpExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id'=>Employee::factory(),
            'company'=>$this->faker->company,
            'role'=>$this->faker->randomElement(['HR', 'QA', 'SE', 'Tester', 'Analyst']),
            'year_of_experience'=>$this->faker->numberBetween(1,20)
        ];
    }
}
