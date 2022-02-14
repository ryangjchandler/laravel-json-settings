<?php

namespace RyanChandler\LaravelJsonSettings;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RyanChandler\LaravelJsonSettings\Commands\LaravelJsonSettingsCommand;

class LaravelJsonSettingsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-json-settings')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-json-settings_table')
            ->hasCommand(LaravelJsonSettingsCommand::class);
    }
}
