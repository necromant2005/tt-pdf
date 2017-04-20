<?php
namespace TweePdf\Service;

class Html2Pdf
{
    public function convert(string $html) : string
    {
        $dirname = '/tmp/' . uniqid() . uniqid() . uniqid() . uniqid();
        mkdir($dirname);

        // $dirname = __DIR__ .'/../../../tmp';
        // @mkdir($dirname);

        copy(__DIR__ . '/casperjs/html2pdf.js', $dirname . '/html2pdf.js');
        file_put_contents($dirname . '/input.html', $html);

        $cmd = 'docker run --rm -v ' . $dirname . ':/mnt necromant2005/tt-pdf '
            . '/usr/local/bin/casperjs '
            . '--ssl-protocol=TLSv1 '
            . '--ignore-ssl-errors=yes '
            . '/mnt/html2pdf.js '
            . '--input=/mnt/input.html '
            . '--output=/mnt/output.pdf ';

        // echo $cmd . PHP_EOL;
        system($cmd);
        $content = file_get_contents($dirname . '/output.pdf');

        @unlink($dirname . '/html2pdf.js');
        @unlink($dirname . '/input.html');
        @unlink($dirname . '/output.pdf');
        rmdir($dirname);

        return $content;
    }
}