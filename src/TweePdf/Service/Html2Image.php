<?php
namespace TweePdf\Service;
use ZendPdf;
use Imagick;

class Html2Image
{
    public function convert($html)
    {
        $tempnam = tempnam(sys_get_temp_dir(), 'converting-html-string');
        file_put_contents($tempnam, 'abc');
        $htmlFile  = $tempnam . '.html';
        $imageFile  = $tempnam . '.png';
        file_put_contents($htmlFile, $html);

        $cmd = '/usr/local/bin/casperjs '
            . escapeshellarg('--ssl-protocol=TLSv1') . ' '
            . escapeshellarg('--ignore-ssl-errors=yes') . ' '
            . escapeshellarg(__DIR__ . '/casperjs/loader.js') . ' '
            . '--input=' . escapeshellarg($htmlFile) . ' '
            . '--output=' . escapeshellarg($imageFile);
        @system($cmd);
        $content = file_get_contents($imageFile);
        @unlink($tempnam);
        @unlink($htmlFile);
        @unlink($imageFile);
        return $content;
    }
}