<?php

namespace Database\Factories;

use App\Models\Employee; 
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    private static $employeeIdCounter = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employeeId = 'EMP' . str_pad(self::$employeeIdCounter++, 2, '0', STR_PAD_LEFT);
        return [
            'employee_id' =>$employeeId,
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
