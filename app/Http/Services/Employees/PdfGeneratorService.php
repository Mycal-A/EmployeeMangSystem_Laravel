<?php

namespace App\Http\Services\Employees;

use App\Models\Employee,EmpEducation;
use Codedge\Fpdf\Fpdf\Fpdf ;

class PdfGeneratorService
{
    public function generatePdf(Employee $employee)
    {
        
        $fpdf = new Fpdf();
        $fpdf->AddPage();

        $fpdf->setXY(0, $y = 3);
        $fpdf->setFont('arial', 'BU',20);
        $fpdf->Cell($fpdf->GetPageWidth(), 20, 'Employee Details ', 0, 1, "C");

        $fpdf->SetFont('Arial', '', 16);

        //$fpdf->Cell(50, 25, 'Name: ' . $employee->name);
        $this->addRow($fpdf, 'Employee ID:', $employee->employee_id);
        $this->addRow($fpdf, 'Name:', $employee->name);
        $this->addRow($fpdf, 'Email:', $employee->email);
        $this->addRow($fpdf, 'Location:', $employee->location);
        $this->addRow($fpdf, 'Email:', $employee->email);
        $this->addRow($fpdf, 'Role:', $employee->role);
        $this->addRow($fpdf, 'Salary:', $employee->salary);

        

        //Education Secition
        $fpdf->Ln();
        $this->addSectionHeader($fpdf, 'Education Details');
       
        $educations = $employee->educations ?? [];
        $fpdf->SetFont('Arial', 'B', 12);
        
        $fpdf->Cell(63, 6, 'Institution', 1, 0);
        $fpdf->Cell(63, 6, 'CGPA', 1, 0);
        $fpdf->Cell(63, 6, 'Graduation Year', 1, 1);

        foreach ($educations as $education) {
            $fpdf->SetFont('Arial', '', 10);
        
            $fpdf->Cell(63, 6, $education['institution'], 1, 0);
            $fpdf->Cell(63, 6, $education['cgpa'], 1, 0);
            $fpdf->Cell(63, 6, $education['graduation_year'], 1, 1);
        }

        //Experience Secition
        $fpdf->Ln();
        $this->addSectionHeader($fpdf, 'Experience Details');
       
        $experiences = $employee->experiences ?? [];
        $fpdf->SetFont('Arial', 'B', 12);
        
        $fpdf->Cell(63, 6, 'Company', 1, 0);
        $fpdf->Cell(63, 6, 'Role', 1, 0);
        $fpdf->Cell(63, 6, 'Year of Experience', 1, 1);

        foreach ($experiences as $experience) {
            $fpdf->SetFont('Arial', '', 10);
            
            $fpdf->Cell(63, 6, $experience['company'], 1, 0);
            $fpdf->Cell(63, 6, $experience['role'], 1, 0);
            $fpdf->Cell(63, 6, $experience['year_of_experience'], 1, 1);
        }
        
        //Family section
        $fpdf->Ln();
        $this->addSectionHeader($fpdf, 'Family Details');

        $familyData = $employee->families ?? [];

        // $familyLabels= ['ID','Name','Relationship','DOB'];
        // foreach ($familyLabels as $label) {
        //     $this->addlabel($fpdf, $label);
        // }

        $fpdf->SetFont('Arial', 'B', 12);
        
        $fpdf->Cell(63, 6, 'Name', 1, 0);
        $fpdf->Cell(63, 6, 'Relationship', 1, 0);
        $fpdf->Cell(63, 6, 'DOB', 1, 1);

        foreach ($familyData as $family) {
            $fpdf->SetFont('Arial', '', 10);
            $fpdf->Cell(63, 6, $family['name'], 1, 0);
            $fpdf->Cell(63, 6, $family['relationship'], 1, 0);
            $fpdf->Cell(63, 6, $family['dob'], 1, 1);
        }


        $fpdf->Output();
        exit;
    }

    private function addlabel(Fpdf $fpdf,$label){

        $fpdf->Cell(48, 6, $label, 1, 0);
    }

    private function addRow(Fpdf $fpdf, $label, $value, $columnWidth = 50)
    {
        $fpdf->Cell(100, 10, $label, 1, 0);
        $fpdf->Cell(90, 10, $value, 1, 1);
    }
    
    private function addVerticalRow(Fpdf $fpdf, $value)
    {
        
        $cellWidth =50; 
        $fpdf->Cell($cellWidth, 10, $value, 1, 0);
    }
    private function addSectionHeader(Fpdf $fpdf, $header)
    {
        $fpdf->SetFont('Arial', 'B', 14);
        $fpdf->Cell(0, 10, $header, 0, 1);
        $fpdf->SetFont('Arial', 'B', 14);
    }
    

}
