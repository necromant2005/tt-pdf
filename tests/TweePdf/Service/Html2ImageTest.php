<?php
namespace TweePdf\Service;
use PHPUnit_Framework_TestCase;

class Html2ImageTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $service = new Html2Image();
        $content = $service->convert(file_get_contents(__DIR__ . '/_files/report.html'));
        $this->assertEquals('PNG', substr($content, 1, 3));
        $this->assertGreaterThan(100 * 1024, strlen($content));
    }
}