<?php

namespace App\Exports\Employee;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

class EmployeesExport implements FromCollection, WithHeadings, WithMultipleSheets, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $selectedColumns;

    public function __construct($selectedColumns)
    {
        $this->selectedColumns = $selectedColumns;
    }
    public function collection()
    {
        // Retrieve only selected columns
        $employees = Employee::select($this->selectedColumns)->get();

        return $employees;
    }
    public function headings(): array
    {
        // Use $this->selectedColumns as headings
        return $this->selectedColumns;
    }

    public function title(): string
    {
        return 'EmployeesDetails';
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        // Add employees sheet
        $sheets[] = new EmployeesExport($this->selectedColumns);

        // Add family sheet
        $sheets[] = new FamilySheet();
        $sheets[] = new EducationSheet();
        $sheets[] = new ExperienceSheet();

        return $sheets;
    }
}

