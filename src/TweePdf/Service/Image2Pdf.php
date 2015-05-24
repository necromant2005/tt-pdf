<?php
namespace TweePdf\Service;
use Imagick;

class Image2Pdf
{
    public function convert($blob)
    {
        $image = new Imagick();
        $image->readImageBlob($blob);
        $image->setImageFormat('pdf');
        return $image->getImageBlob();
    }
}