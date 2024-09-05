<?php

namespace ChuckGreenman\DdlToLaravel;

use Illuminate\Support\ServiceProvider;

class DdlToLaravelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerCommands();
    }

    public function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\DownloadAndParseBlueprintFileCommand::class,
            ]);
        }
    }
}
