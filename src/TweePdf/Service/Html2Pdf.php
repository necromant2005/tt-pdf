<?php
namespace TweePdf\Service;

class Html2Pdf
{
    public function convert($html, $mode = 'pdf-page')
    {
        $service = $mode == 'pdf' ? new Image2Pdf() : new Image2PdfPage();
        $blob = (new Html2Image)->convert($html);
        return $service->convert($blob);
    }
}