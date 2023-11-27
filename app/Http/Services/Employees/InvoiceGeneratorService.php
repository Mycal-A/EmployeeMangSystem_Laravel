<?php

namespace App\Http\Services\Employees;

use App\Models\Employee,EmpEducation;
use Codedge\Fpdf\Fpdf\Fpdf ;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;


class InvoiceGeneratorService
{
    public function generateInvoice()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        $html = View::make('user.invoice')->render();

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream('invoice.pdf', ['Attachment' => 0]);
    }
    

}
