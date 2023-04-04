<?php

namespace NjoguAmos\Plausible;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PlausibleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name(name: 'plausible')
            ->hasTranslations()
            ->hasConfigFile(configFileName: 'plausible')
            ->hasInstallCommand(callable: function (InstallCommand $command) {
                $command
                    ->startWith(callable: function (InstallCommand $command) {
                        $command->info(string: 'Welcome! We are going to publish service provider and config files.');
                    })
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub(vendorSlashRepoName: 'njoguamos/laravel-plausible')
                    ->endWith(callable: function (InstallCommand $command) {
                        $command->info(string: 'Congratulation! You add your turnstile key and you are ready to go. Happy coding!');
                    });
            });
    }
}
