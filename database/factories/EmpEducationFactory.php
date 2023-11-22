<?php

namespace Database\Factories;
use App\Models\EmpEducation;
use App\Models\Employee;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmpEducation>
 */
class EmpEducationFactory extends Factory
{
    protected $model = EmpEducation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'employee_id' =>Employee::factory(),
            'institution'=>$this->faker->company,
            'course' => $this->faker->randomElement(['BCA', 'MCA', 'BE', 'B.Tech', 'B.Sc IT']),
            'cgpa' => $this->faker->randomFloat(1, 0, 4),
            'graduation_year' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y'),

        ];
    }
}
