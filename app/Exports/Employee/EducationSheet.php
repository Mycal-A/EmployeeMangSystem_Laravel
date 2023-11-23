<?php

namespace App\Exports\Employee;

use App\Models\EmpEducation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class EducationSheet implements FromCollection, WithHeadings, WithTitle
{
    public $employees;

    public function __construct($employees)
    {
        $this->employees=$employees;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Transform employee data to education details
        $educationDetails = $this->employees->map(function ($employee) {
            // Assuming 'educations' relationship exists on the Employee model
            $educations = $employee->educations;

            // Extract relevant information for each education
            return $educations->map(function ($education) use ($employee) {
                return [
                    'Employee_Name' => $employee->name,
                    'Institution' => $education->institution,
                    'CGPA' => $education->cgpa,
                    'Graduation_Year' => $education->graduation_year,
                ];
            });
        });

        return $educationDetails;
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
