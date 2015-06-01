<?php
namespace TweePdf\Service;

class Html2Pdf
{
    public function convert($html, $mode = '')
    {
        switch ($mode) {
            case 'img-pdf':
                $blob = (new Html2Image)->convert($html);
                return (new Image2Pdf())->convert($blob);
                break;
            case 'img-html-pdf':
                $blob = (new Html2Image)->convert($html);
                return (new Image2PdfPage())->convert($blob);
                break;
            default:
                break;
        }

        $tempnam = tempnam(sys_get_temp_dir(), 'converting-html-to-pdf-');
        file_put_contents($tempnam, 'abc');
        $htmlFile  = $tempnam . '.html';
        $pdfFile   = $tempnam . '.pdf';

        file_put_contents($htmlFile, $html);

        $cmd = '/usr/local/bin/casperjs '
            . escapeshellarg('--ssl-protocol=TLSv1') . ' '
            . escapeshellarg('--ignore-ssl-errors=yes') . ' '
            . escapeshellarg(__DIR__ . '/casperjs/html2pdf.js') . ' '
            . '--input=' . escapeshellarg($htmlFile) . ' '
            . '--output=' . escapeshellarg($pdfFile);
        @system($cmd);
        $content = file_get_contents($pdfFile);

        @unlink($tempnam);
        @unlink($htmlFile);
        @unlink($pdfFile);
        return $content;
    }
}