<?php
namespace TweePdf\Service;
use Imagick;

class Html2Pdf
{
    public function convert($html)
    {
        $service = new Html2Image();
        $blob = $service->convert($html);

        $tempnam = tempnam(sys_get_temp_dir(), 'converting-img-pdf-');
        file_put_contents($tempnam, 'abc');
        $imageFile = $tempnam . '.png';
        $pdfFile   = $tempnam . '.pdf';

        file_put_contents($imageFile, $blob);
        $cmd = '/usr/bin/convert ' . escapeshellarg($imageFile) . ' ' . escapeshellarg($pdfFile);
        @system($cmd);

        $content = file_get_contents($pdfFile);
        @unlink($tempnam);
        @unlink($imageFile);
        @unlink($pdfFile);
        return $content;
        //$image = new Imagick();
        //$image->readImageBlob($blob);
        //$image->setImageFormat('pdf');
        //return $image->getImageBlob();
    }
}