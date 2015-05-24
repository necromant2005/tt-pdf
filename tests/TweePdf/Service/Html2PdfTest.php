<?php
namespace TweePdf\Service;
use PHPUnit_Framework_TestCase;

class Html2PdfTest extends PHPUnit_Framework_TestCase
{
    public function testPdfPage()
    {
        $service = new Html2Pdf();
        $content = $service->convert(file_get_contents(__DIR__ . '/_files/report.html'));
        $this->assertEquals('PDF', substr($content, 1, 3));
        $this->assertGreaterThan(100 * 1024, strlen($content));
    }

    public function testPdfOnePage()
    {
        $service = new Html2Pdf();
        $content = $service->convert(file_get_contents(__DIR__ . '/_files/report.html'), 'pdf');
        $this->assertEquals('PDF', substr($content, 1, 3));
        $this->assertGreaterThan(100 * 1024, strlen($content));
    }
}