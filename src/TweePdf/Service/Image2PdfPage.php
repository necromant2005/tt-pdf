<?php
namespace TweePdf\Service;
use ZendPdf;
use Imagick;

class Image2PdfPage
{
    public function convert($image)
    {
        $tempnam = tempnam(sys_get_temp_dir(), 'converting-image-to-pdf-');
        file_put_contents($tempnam, 'abc');
        $htmlFile  = $tempnam . '.html';
        $imageFile = $tempnam . '.png';
        $pdfFile   = $tempnam . '.pdf';

        file_put_contents($imageFile, $image);
        file_put_contents($htmlFile, $this->getHtml($imageFile));

        $cmd = '/usr/local/bin/casperjs '
            . escapeshellarg('--ssl-protocol=TLSv1') . ' '
            . escapeshellarg('--ignore-ssl-errors=yes') . ' '
            . escapeshellarg(__DIR__ . '/casperjs/image2pdf-page.js') . ' '
            . '--input=' . escapeshellarg($htmlFile) . ' '
            . '--output=' . escapeshellarg($pdfFile);
        @system($cmd);
        $content = file_get_contents($pdfFile);

        @unlink($tempnam);
        @unlink($htmlFile);
        @unlink($imageFile);
        @unlink($pdfFile);
        return $content;
    }

    private function getHtml($imageFile)
    {
        $html = '';
        $html .= '<style>' . PHP_EOL;
        $html .= 'body, img {' . PHP_EOL;
        $html .= '  margin: 0;' . PHP_EOL;
        $html .= '  width: 1024;' . PHP_EOL;
        $html .= '  padding: 0;' . PHP_EOL;
        $html .= '  border: none;' . PHP_EOL;
        $html .= '}' . PHP_EOL;
        $html .= '</style>' . PHP_EOL;

        $html .= '<img src="file://' . $imageFile . '" />';
        return $html;
    }
}