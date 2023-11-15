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
        $Columns = ['id','employee_id','name', 'relationship', 'dob'];
        return EmpFamily::select($Columns);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define headings for family sheet
        return ['ID','Employee_id', 'Name', 'Relationship', 'DOB'];
    }

    public function title(): string
    {
        return 'FamilyDetails';
    }
}
