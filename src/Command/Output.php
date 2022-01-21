<?php

namespace Hansen\Commander\Command;

class Output
{
    public function write(string $text, bool $newLine = false)
    {
        if (!$newLine) {
            echo $text;
        } else {
            echo $text . PHP_EOL;
        }
    }

    public function writeln(string $text)
    {
        echo $text;
    }
}
