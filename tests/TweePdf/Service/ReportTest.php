<?php
namespace TweePdf\Service;
use PHPUnit_Framework_TestCase;

class ReportTest extends PHPUnit_Framework_TestCase
{
    public function testExtremum()
    {
        $service = new Report();
        $service->toPdf(file_get_contents(__DIR__ . '/_files/report.html'));
    }
}