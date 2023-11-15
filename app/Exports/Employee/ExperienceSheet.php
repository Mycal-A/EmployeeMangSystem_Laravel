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
        $Columns = ['id','employee_id','company', 'role', 'year_of_experience'];
        return EmpExperience::select($Columns);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define headings for family sheet
        return ['ID','Employee_ID', 'Company', 'Role', 'Year Of Experience'];
    }

    public function title(): string
    {
        return 'ExperienceDetailsDetails';
    }
}
