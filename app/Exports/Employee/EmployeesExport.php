<?php

namespace App\Exports\Employee;


use App\Models\Employee;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EmployeesExport implements FromCollection, WithHeadings, WithMultipleSheets, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $selectedColumns;
    public $employees;

    public function __construct($selectedColumns)
    {
        $this->employees = Employee::with(['experiences','educations','families'])->get();
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
        return array_map('ucfirst',$this->selectedColumns);
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

        $sheets[] = new EmployeesExport($this->selectedColumns);
        $sheets[] = new FamilySheet($this->employees);
        $sheets[] = new EducationSheet($this->employees);
        $sheets[] = new ExperienceSheet($this->employees);

        return $sheets;
    }
}

