<?php
namespace TweePdf\Service;

class Html2Pdf
{
    public function convert(string $html, string $realpath = '') : string
    {
        if (empty($realpath)) {
            $realpath = getcwd();
        }

        $dirname = 'tmp/' . hrtime(true) . '_' . uniqid();
        //$dirname = 'tmp/html2pdf';
        mkdir($dirname);

        file_put_contents($dirname . '/input.html', $html);

        $cmd = 'docker run --rm -v ' . $realpath . '/' . $dirname . ':/mnt truesocialmetrics/pdf-rendering '
            . 'node /html2pdf.js '
            . '/mnt/input.html '
            . '/mnt/output.pdf ';

        // echo $cmd . PHP_EOL;
        system($cmd);
        $content = file_get_contents($dirname . '/output.pdf');

        @unlink($dirname . '/input.html');
        @unlink($dirname . '/output.pdf');
        rmdir($dirname);

        return $content;
    }
}
