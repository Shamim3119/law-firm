<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FPDF;

class PdfController extends Controller
{
    public function generate()
    {
        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Hello, this is PDF in Laravel!', 0, 1);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Generated using FPDF library.', 0, 1);

        return response($pdf->Output('S'))
            ->header('Content-Type', 'application/pdf');
    }
}