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
        $columns = ['employees.name as employee_name', 'emp_education.institution', 'emp_education.cgpa', 'emp_education.graduation_year'];
        return EmpEducation::select($columns)
            ->join('employees', 'emp_education.employee_id', '=', 'employees.id');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define headings for family sheet
        return [ 'Employee_Name', 'Institution', 'CGPA','Graduation Year'];
    }

    public function title(): string
    {
        return 'EducationDetails';
    }
}
