<?php
namespace TweePdf\Service;
use PHPUnit_Framework_TestCase;

class ReportTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $service = new Report();
        $content = $service->toPdf(file_get_contents(__DIR__ . '/_files/report.html'));
        $this->assertEquals('%PDF', substr($content, 0, 4));
    }
}