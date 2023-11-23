<?php

namespace App\Exports\Employee;

use App\Models\EmpFamily;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class FamilySheet implements FromCollection, WithHeadings, WithTitle
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
        // Transform employee data to family details
        $familyDetails = $this->employees->map(function ($employee) {
            // Assuming 'families' relationship exists on the Employee model
            $families = $employee->families;

            // Extract relevant information for each family member
            return $families->map(function ($family) use ($employee) {
                return [
                    'Employee_Name' => $employee->name,
                    'Name' => $family->name,
                    'Relationship' => $family->relationship,
                    'DOB' => $family->dob,
                ];
            });
        });

        return $familyDetails;
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
