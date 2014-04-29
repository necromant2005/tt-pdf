<?php
namespace TweePdf\Service;
use ZendPdf;

class Report
{
    public function toPdf(array $configuration)
    {
        $tmp = '/tmp/x.pdf';
        $pdf = new ZendPdf\PdfDocument();
        $pdf->save($tmp);
        return file_get_contents($tmp);
    }
}