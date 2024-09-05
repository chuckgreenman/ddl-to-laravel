<?php

namespace ChuckGreenman\DdlToLaravel\Console;

use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Attribute\AsCommand;
use Illuminate\Support\Str;
use ChuckGreenman\DdlToLaravel\DdlToLaravelServiceProvider;

#[AsCommand(name: "ddl-to-laravel:install")]
class InstallCommand extends Command
{
    protected $signature = "ddl-to-laravel:install";

    protected $description = "Install the DdlToLaravel package";

    public function handle(): void
    {
        $this->registerDdlToLaravelServiceProvider();
    }

    public function registerDdlToLaravelServiceProvider(): void
    {
        if (
            method_exists(
                ServiceProvider::class,
                "addProviderToBootstrapFile"
            ) &&
            ServiceProvider::addProviderToBootstrapFile(
                DdlToLaravelServiceProvider::class
            )
        ) {
            return;
        }
    }
}
