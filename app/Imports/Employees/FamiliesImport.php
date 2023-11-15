<?php

namespace App\Imports\Employees;

use Carbon\Carbon;
use App\Models\EmpFamily;
use Maatwebsite\Excel\Concerns\ToModel;

class FamiliesImport implements ToModel
{
    protected $rowCount = 0;

    public function model(array $row)
    {
        if ($this->rowCount === 0) {
            $this->rowCount++;
            return null;
        }
        
        
        
        // Create a new Family model using the mapped data
        return new EmpFamily([
            'employee_id' => (int) $row[0], // cast to integer
            'name' => (string) $row[1], // cast to string
            'relationship' => (string) $row[2], // cast to string
            'dob' => Carbon::createFromFormat('d-m-Y', $row[3]),
        ]);
    }
}
