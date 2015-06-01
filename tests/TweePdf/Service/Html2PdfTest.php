<?php
namespace TweePdf\Service;
use PHPUnit_Framework_TestCase;

class Html2PdfTest extends PHPUnit_Framework_TestCase
{
    public function testPdf()
    {
        $service = new Html2Pdf();
        $content = $service->convert(file_get_contents(__DIR__ . '/_files/report.html'));
        $this->assertEquals('PDF', substr($content, 1, 3));
        $this->assertGreaterThan(100 * 1024, strlen($content));
    }

    public function testImgPdf()
    {
        $service = new Html2Pdf();
        $content = $service->convert(file_get_contents(__DIR__ . '/_files/report.html'), 'img-pdf');
        $this->assertEquals('PDF', substr($content, 1, 3));
        $this->assertGreaterThan(100 * 1024, strlen($content));
    }

    public function testImgHtmlPage()
    {
        $service = new Html2Pdf();
        $content = $service->convert(file_get_contents(__DIR__ . '/_files/report.html'), 'img-html-pdf');
        $this->assertEquals('PDF', substr($content, 1, 3));
        $this->assertGreaterThan(100 * 1024, strlen($content));
    }
}