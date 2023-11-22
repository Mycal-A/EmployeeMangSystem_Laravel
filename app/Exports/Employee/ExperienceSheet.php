<?php

namespace App\Exports\Employee;

use App\Models\EmpExperience;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ExperienceSheet implements FromQuery, WithHeadings, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        // Retrieve family details
        $columns = ['employees.name as employee_name', 'emp_experiences.company', 'emp_experiences.role', 'emp_experiences.year_of_experience'];
        return EmpExperience::select($columns)
            ->join('employees', 'emp_experiences.employee_id', '=', 'employees.id');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define headings for family sheet
        return ['Employee_Name', 'Company', 'Role', 'Year Of Experience'];
    }

    public function title(): string
    {
        return 'ExperienceDetailsDetails';
    }
}
