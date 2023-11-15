<?php

// app/Imports/YourImportClass.php

namespace App\Imports\Employees;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BulkUploadClass implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Employees' => new EmployeesImport(),
            'Families' => new FamiliesImport(),
            'Educations' => new EducationsImport(),
            'Experiences' => new ExperiencesImport(),            
        ];
    }
}
