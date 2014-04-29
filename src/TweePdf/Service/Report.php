<?php
namespace TweePdf\Service;
use ZendPdf;

class Report
{
    public function toPdf(array $configuration)
    {
        $pdf = new ZendPdf\PdfDocument();
        return $pdf->render();
    }
}