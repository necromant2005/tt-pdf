<?php
namespace TweePdf\Service;
use PHPUnit\Framework\TestCase;

class Html2PdfTest extends TestCase
{
    private function realpath()
    {
        if (getenv('REAL_PATH')) {
            return getenv('REAL_PATH') . '/pdf-rendering';
        } else {
            return getcwd();
        }
    }


    public function testPdf()
    {
        if (!getenv('REAL_PATH')) {
            $this->assertTrue(true);
            return;
        }

        $service = new Html2Pdf();
        $content = $service->convert(file_get_contents(__DIR__ . '/_files/report.html'), $this->realpath());
        $this->assertGreaterThan(50 * 1000, strlen($content));
        $this->assertEquals('PDF', substr($content, 1, 3));
    }

    public function testPdfLarge()
    {
        if (!getenv('REAL_PATH')) {
            $this->assertTrue(true);
            return;
        }

        $service = new Html2Pdf();
        $content = $service->convert(str_repeat(file_get_contents(__DIR__ . '/_files/report.html'), 10), $this->realpath());
        $this->assertGreaterThan(50 * 1000, strlen($content));
        $this->assertEquals('PDF', substr($content, 1, 3));
    }

    public function testPdfNoDocker()
    {
        if (getenv('REAL_PATH')) {
            $this->assertTrue(true);
            return;
        }

        $service = new Html2Pdf();
        $content = $service->convert(file_get_contents(__DIR__ . '/_files/report.html'));
        $this->assertGreaterThan(50 * 1000, strlen($content));
        $this->assertEquals('PDF', substr($content, 1, 3));
    }
}
