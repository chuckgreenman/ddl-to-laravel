<?php

namespace ChuckGreenman\DdlToLaravel\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: "ddl-to-laravel:download-and-parse-blueprint-file")]
class DownloadAndParseBlueprintFileCommand extends Command
{
    protected $signature = "ddl-to-laravel:download-and-parse-blueprint-file";

    protected $description = "Download and parse a blueprint file";

    public function handle()
    {
        $this->info("Download and parse a blueprint file");
    }
}
