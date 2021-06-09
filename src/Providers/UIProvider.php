<?php

namespace Bastinald\UI\Providers;

use Bastinald\UI\Commands\ComponentCommand;
use Bastinald\UI\Commands\InstallCommand;
use Bastinald\UI\Commands\MigrateCommand;
use Bastinald\UI\Commands\ModelCommand;
use Bastinald\UI\Components\Modal;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class UIProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ComponentCommand::class,
                InstallCommand::class,
                MigrateCommand::class,
                ModelCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../config/ui.php' => config_path('ui.php'),
        ]);
        
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'ui');

        $this->publishes([
            __DIR__ . '/../../views' => resource_path('views/vendor/ui'),
        ]);

        Livewire::component('modal', Modal::class);
    }
}
