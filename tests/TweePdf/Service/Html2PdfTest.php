<?php
namespace TweePdf\Service;
use PHPUnit\Framework\TestCase;

class Html2PdfTest extends TestCase
{
    public function testPdf()
    {
        $service = new Html2Pdf();
        $content = $service->convert(file_get_contents(__DIR__ . '/_files/report.html'));
        $this->assertGreaterThan(50 * 1000, strlen($content));
        $this->assertEquals('PDF', substr($content, 1, 3));
    }

    public function testPdfLarge()
    {
        $service = new Html2Pdf();
        $content = $service->convert(str_repeat(file_get_contents(__DIR__ . '/_files/report.html'), 10));
        $this->assertGreaterThan(50 * 1000, strlen($content));
        $this->assertEquals('PDF', substr($content, 1, 3));
    }
}
