<?php

namespace App\Imports\Employees;

use Carbon\Carbon;
use App\Models\EmpExperience;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class ExperiencesImport implements ToModel
{
    protected $rowCount = 0;
    protected $groupedData = [];

    public function model(array $row)
    {
        if ($this->rowCount === 0) {
            $this->rowCount++;
            return null;
        }

        // Find the employee based on the provided employee_id
        $employee = Employee::where('employee_id', $row[0])->first();

        // Check if the employee exists
        if ($employee) {
            // Create a new Experience model using the mapped data
            $experienceData = [
                'employee_id' => $employee->id,
                'company' => (string) $row[1],
                'role' => (string) $row[2],
                'year_of_experience' => (int) $row[3],
            ];

            $this->groupedData[] = $experienceData;

            return new EmpExperience($experienceData);
        }

        return null; // No matching employee found for the given employee_id
    }

    public function groupByEmployeeId()
    {
        // Use Laravel's collection to group the data by employee_id
        $groupedData = collect($this->groupedData)->groupBy('employee_id')->toArray();

        return $groupedData;
    }
}
