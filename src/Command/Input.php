<?php

namespace Hansen\Commander\Command;

class Input
{
    public function quest(string $text, $callback)
    {
        $qst = readline($text);
        call_user_func($callback, new Output, $qst);
    }
}
