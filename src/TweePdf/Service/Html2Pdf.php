<?php
namespace TweePdf\Service;
use ZendPdf;
use Imagick;

class Html2Pdf
{
    public function convert($html)
    {
        $tempnam = tempnam(sys_get_temp_dir(), 'converting-html-string');
        file_put_contents($tempnam, 'abc');
        $imageFile  = $tempnam . '.png';
        $pdfFile  = $tempnam . '.pdf';

        $service = new Html2Image();
        $content = $service->convert($html);
        file_put_contents($imageFile, $content);

        $im = new Imagick($imageFile);
        $im->writeImage($pdfFile);

        $content = file_get_contents($pdfFile);
        @unlink($tempnam);
        @unlink($imageFile);
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