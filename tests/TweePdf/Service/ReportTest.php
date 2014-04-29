<?php
namespace TweePdf\Service;
use PHPUnit_Framework_TestCase;

class ReportTest extends PHPUnit_Framework_TestCase
{
    public function testExtremum()
    {
        $service = new Report();
        $pdf = $service->toPdf(
            array(
                array(
                    'type'     => 'image',
                    'filename' => __FILE__ . '/_files/chart.png',
                ),
                array(
                    'type' => 'table',
                    'cols' => array(
                      'date',
                      'replies',
                      'retweets',
                      'favorites',
                      'text',
                    ),
                    'labels' => array(
                      'Date',
                      'Replies',
                      'Reshares',
                      'Favourites',
                      'Text',
                    ),
                    'formatting' => array(
                        'date' => function($value) { return date('M d, Y', $value); },
                    ),
                    'data' => array(
                        array(
                            'date'      => '1398715212',
                            'replies'   => 1,
                            'retweets'  => 2,
                            'favorites' => 3,
                            'text'      => 'test text',
                        ),
                    ),
                ),
            )
        );
        $this->assertEquals('%PDF', substr($pdf, 0, 4));
    }
}