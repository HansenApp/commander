<?php

namespace Hansen\Commander\Application;

use Hansen\Commander\Command\Input;
use Hansen\Commander\Command\Output;

class App
{
    protected      $name;
    protected   $version;
    protected   $command;

    public function __construct(string $name = 'Undefined', $version = '1.0.0')
    {
        $this->name    = $name;
        $this->version = $version;
    }

    protected function showHelp()
    {
        $name          = $this->name;
        $version       = $this->version;

        echo "\n\033[1;37m< \033[1;31m$name \033[1;37m> @ \033[1;34m$version\033[1;37m\n";
        echo ">> Command List\n";
        echo "\n\033[1;32mhelp \033[1;37m| \033[1;34mShow command list\033[1;37m\n";
        foreach ($this->command as $name => $value) {
            foreach ($value as $desc => $run) {
                echo "\033[1;32m$name \033[1;37m| \033[1;34m$desc\033[1;37m";
            }
        }
        echo PHP_EOL;
    }

    public function add($cmd)
    {
        $config = $cmd->config();
        $this->command[$config["name"]][$config["description"]] = $config["run"];
    }

    public function run()
    {
        global $argv;
        $cmd = $argv[1] ?? null;
        $args = $argv[2] ?? null;
        $option = $argv[2] ?? null;

        if ($cmd == null) {
            $this->showHelp();
        }

        foreach ($this->command as $name => $value) {
            foreach ($value as $desc => $run) {
                if ($cmd == $name) {
                    $run(new Output(), new Input());
                }
            }
        }
    }
}
