<?php
namespace TweePdf\Service;
use PHPUnit_Framework_TestCase;

class Image2PdfTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $service = new Image2Pdf();
        $content = $service->convert(file_get_contents(__DIR__ . '/_files/report.png'));
        $this->assertEquals('PDF', substr($content, 1, 3));
        $this->assertGreaterThan(1024 * 1024, strlen($content));
    }
}