<?php

namespace App\Imports\Employees;

use Carbon\Carbon;
use App\Models\EmpEducation;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\YearFrac;

class EducationsImport implements ToModel
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
            // Create a new Education model using the mapped data
            $educationData = [
                'employee_id' => $employee->id,
                'course' => (string) $row[1],
                'institution' => (string) $row[2],
                'cgpa' => (string) $row[3],
                'graduation_year' => (string) $row[4],
            ];

            $this->groupedData[] = $educationData;

            return new EmpEducation($educationData);
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
