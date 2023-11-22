<?php

namespace App\Exports\Employee;

use App\Models\EmpFamily;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class FamilySheet implements FromQuery, WithHeadings, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        // Retrieve family details
        $columns = ['employees.name as employee_name','emp_families.name', 'emp_families.relationship', 'emp_families.dob'];
        return EmpFamily::select($columns)
            ->join('employees', 'emp_families.employee_id', '=', 'employees.id');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define headings for family sheet
        return ['Employee_Name', 'Name', 'Relationship', 'DOB'];
    }

    public function title(): string
    {
        return 'FamilyDetails';
    }
}
