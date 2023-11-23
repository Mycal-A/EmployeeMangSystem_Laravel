<?php

namespace App\Http\Controllers;

use App\Http\Services\Employees\PdfGeneratorService;
use Illuminate\Http\Request;
use App\Models\Employee;
use Codedge\Fpdf\Fpdf\Fpdf ;

class PdfController extends Controller
{
    public function generatePdf(Employee $employee,PdfGeneratorService $pdfGenerator)
    {
        return $pdfGenerator->generatePdf($employee);
    }
   
}
