<?php
namespace TweePdf\Service;
use Imagick;

class Html2Pdf
{
    public function convert($html)
    {
        $service = new Html2Image();
        $blob = $service->convert($html);

        $image = new Imagick();
        $image->readImageBlob($blob);
        $image->setImageFormat('pdf');
        return $image->getImageBlob();
    }
}