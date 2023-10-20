<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'location' => $this->faker->city(),
            'salary' => $this->faker->randomNumber(5),
            'role' => $this->faker->randomElement(['Developer', 'QA Engineer', 'System Administrator', 'Database Analyst', 'UI/UX Designer', 'Network Engineer']),
            'access' => $this->faker->randomElement([0, 1]),

        ];
    }
}
