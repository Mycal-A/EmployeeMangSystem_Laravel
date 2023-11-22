<?php

namespace App\Imports\Employees;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class EmployeesImport implements ToModel
{
   
    protected $rowCount = 0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        if ($this->rowCount === 0) {
            $this->rowCount++;
            return null;
        }
        // Create a new Employee model using direct array access
        return new Employee([
            'employee_id' => (string) $row[0], // cast to string
            'name' => (string) $row[1], // cast to string
            'email' => (string) $row[2], // cast to string
            'location' => (string) $row[3], // cast to string
            'password' => bcrypt($row[4]),
            'role' => (string) ($row[5] ?? ''),// cast to string
            'salary' => intval($row[6] ?? ''), // convert to integer
        ]);
    }
    
}
