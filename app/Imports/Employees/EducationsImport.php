<?php

namespace App\Imports\Employees;

use Carbon\Carbon;
use App\Models\EmpEducation;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\YearFrac;

class EducationsImport implements ToModel
{
    protected $rowCount = 0;

    public function model(array $row)
    {
        if ($this->rowCount === 0) {
            $this->rowCount++;
            return null;
        }
                
        // Create a new Family model using the mapped data
        return new EmpEducation([
            'employee_id' => (int) $row[0], // cast to integer
            'course' => (string) $row[1], // cast to string
            'institution' => (string) $row[2], // cast to string
            'cgpa' => $row[3], // cast to string
            'graduation_year' =>$row[4], // cast to string
            
        ]);
    }
}
