<?php

namespace App\Imports\Employees;

use Carbon\Carbon;
use App\Models\EmpExperience;
use Maatwebsite\Excel\Concerns\ToModel;

class ExperiencesImport implements ToModel
{
    protected $rowCount = 0;

    public function model(array $row)
    {
        if ($this->rowCount === 0) {
            $this->rowCount++;
            return null;
        }
        
        
        
        // Create a new Family model using the mapped data
        return new EmpExperience([
            'employee_id' => (int) $row[0], // cast to integer
            'company' => (string) $row[1], // cast to string
            'role' => (string) $row[2], // cast to string
            'year_of_experience' =>(int) $row[3],
        ]);
    }
}
