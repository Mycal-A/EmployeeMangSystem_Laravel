<?php

namespace App\Imports\Employees;

use Carbon\Carbon;
use App\Models\EmpFamily;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class FamiliesImport implements ToModel
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
            // Create a new Family model using the mapped data
            $familyData = [
                'employee_id' => $employee->id, // Use the ID of the found employee
                'name' => (string) $row[1], 
                'relationship' => (string) $row[2], 
                'dob' => Carbon::createFromFormat('d-m-Y', $row[3]),
            ];
    
            $this->groupedData[] = $familyData;
    
            return new EmpFamily($familyData);
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
