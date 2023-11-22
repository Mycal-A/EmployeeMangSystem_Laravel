<?php

namespace App\Http\Controllers;

use App\Http\Services\Employees\PdfGeneratorService;
use Illuminate\Http\Request;
use App\Models\Employee;
use Codedge\Fpdf\Fpdf\Fpdf ;

class PdfController extends Controller
{
    public function generatePdf($id,PdfGeneratorService $pdfGenerator)
    {
        return $pdfGenerator->generatePdf($id);
    }
   
}
