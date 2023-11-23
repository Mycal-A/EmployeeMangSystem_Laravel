<?php

namespace App\Exports\Employee;

use App\Models\EmpExperience,Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ExperienceSheet implements FromCollection, WithHeadings, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $employees;

    public function __construct($employees)
    {
        $this->employees=$employees;
    }
    public function collection()
    {
        // Transform employee data to experience details
        $experienceDetails = $this->employees->map(function ($employee) {
            // Assuming 'experiences' relationship exists on the Employee model
            $experiences = $employee->experiences;

            // Extract relevant information for each experience
            return $experiences->map(function ($experience) use ($employee) {
                return [
                    'Employee_Name' => $employee->name,
                    'Company' => $experience->company,
                    'Role' => $experience->role,
                    'Year_Of_Experience' => $experience->year_of_experience,
                ];
            });
        }); // Flatten the nested collections

        return $experienceDetails;
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
        return 'ExperienceDetails';
    }
}
