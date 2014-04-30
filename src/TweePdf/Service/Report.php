<?php
namespace TweePdf\Service;
use ZendPdf;
use Imagick;

class Report
{
    public function toPdf($html)
    {
        $tempnam = tempnam(sys_get_temp_dir(), 'converting-html-string');
        $tempnam = '/tmp/x';
        file_put_contents($tempnam, 'abc');
        $htmlFile  = $tempnam . '.html';
        $imageFile  = $tempnam . '.png';
        $pdfFile  = $tempnam . '.pdf';
        file_put_contents($htmlFile, $html);
        $this->html2image($htmlFile, $imageFile);

        $im = new Imagick($imageFile);
        $im->writeImage($pdfFile);

        $content = file_get_contents($pdfFile);
        @unlink($tempnam);
        @unlink($htmlFile);
        @unlink($pdfFile);
        return $content;
    }

    private function html2image($htmlFile, $imageFile)
    {
        $cmd = '/usr/local/bin/casperjs '
            . escapeshellarg('--ignore-ssl-errors=yes') . ' '
            . escapeshellarg(__DIR__ . '/casperjs/loader.js') . ' '
            . '--input=' . escapeshellarg($htmlFile) . ' '
            . '--output=' . escapeshellarg($imageFile);
        system($cmd);
    }
}