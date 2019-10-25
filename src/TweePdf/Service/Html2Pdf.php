<?php
namespace TweePdf\Service;

class Html2Pdf
{
    private const SEPARATOR = 'GNsWoiq7mSOXX5KI2fKXIOy8PlMokuxQ7PAkVRh6xTTkOtREwp';

    public function convert(string $html) : string
    {
        $cmd = 'docker run --rm pdf-docker /mnt/run.sh '
            . base64_encode(file_get_contents(__DIR__ . '/casperjs/html2pdf.js')) . ' '
            . base64_encode($html);

        // echo $cmd . PHP_EOL;

        $content = (string) shell_exec($cmd);
        $position = strpos($content, self::SEPARATOR);

        return substr($content, $position + strlen(self::SEPARATOR) + 1);
    }
}
