<?php

namespace App\Exports\Employee;

use App\Models\EmpEducation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class EducationSheet implements FromQuery, WithHeadings, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        // Retrieve family details
        $Columns = ['id','employee_id', 'institution', 'cgpa','graduation_year'];
        return EmpEducation::select($Columns);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define headings for family sheet
        return ['ID', 'Employee_id', 'Institution', 'CGPA','Graduation Year'];
    }

    public function title(): string
    {
        return 'EducationDetails';
    }
}
