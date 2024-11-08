<?php

namespace Hesete\LaravelPackageMaker;

use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\ServiceProvider;
use Hesete\LaravelPackageMaker\Commands\AddPackage;
use Hesete\LaravelPackageMaker\Commands\ClonePackage;
use Hesete\LaravelPackageMaker\Commands\Database\FactoryMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Database\MigrationMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Database\SeederMakeCommand;
use Hesete\LaravelPackageMaker\Commands\DeletePackageCredentials;
use Hesete\LaravelPackageMaker\Commands\Foundation\ChannelMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\ConsoleMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\EventMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\ExceptionMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\JobMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\ListenerMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\MailMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\ModelMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\NotificationMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\ObserverMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\PolicyMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\ProviderMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\RequestMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\ResourceMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\RuleMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Foundation\TestMakeCommand;
use Hesete\LaravelPackageMaker\Commands\NovaMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Package\BaseTestMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Package\CodecovMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Package\ComposerMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Package\ContributionMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Package\GitignoreMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Package\LicenseMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Package\PhpunitMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Package\ReadmeMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Package\StyleciMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Package\TravisMakeCommand;
use Hesete\LaravelPackageMaker\Commands\PackageMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Replace;
use Hesete\LaravelPackageMaker\Commands\Routing\ControllerMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Routing\MiddlewareMakeCommand;
use Hesete\LaravelPackageMaker\Commands\SavePackageCredentials;
use Hesete\LaravelPackageMaker\Commands\Standard\AnyMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Standard\ContractMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Standard\InterfaceMakeCommand;
use Hesete\LaravelPackageMaker\Commands\Standard\TraitMakeCommand;

class LaravelPackageMakerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(MigrationCreator::class)
            ->needs('$customStubPath')
            ->give(function ($app) {
                return $app->basePath('stubs');
            });
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands(
            array_merge(
                $this->routingCommands(),
                $this->packageCommands(),
                $this->databaseCommands(),
                $this->standardCommands(),
                $this->foundationCommands(),
                $this->packageInternalCommands()
            )
        );
    }

    /**
     * Get package database related commands.
     *
     * @return array
     */
    protected function databaseCommands()
    {
        return [
            SeederMakeCommand::class,
            FactoryMakeCommand::class,
            MigrationMakeCommand::class,
        ];
    }

    /**
     * Get package foundation related commands.
     *
     * @return array
     */
    protected function foundationCommands()
    {
        return [
            JobMakeCommand::class,
            MailMakeCommand::class,
            TestMakeCommand::class,
            RuleMakeCommand::class,
            EventMakeCommand::class,
            ModelMakeCommand::class,
            PolicyMakeCommand::class,
            ConsoleMakeCommand::class,
            RequestMakeCommand::class,
            ChannelMakeCommand::class,
            ProviderMakeCommand::class,
            ListenerMakeCommand::class,
            ObserverMakeCommand::class,
            ResourceMakeCommand::class,
            ExceptionMakeCommand::class,
            NotificationMakeCommand::class,
        ];
    }

    /**
     * Get package related commands.
     *
     * @return array
     */
    protected function packageCommands()
    {
        return [
            NovaMakeCommand::class,
            ReadmeMakeCommand::class,
            TravisMakeCommand::class,
            LicenseMakeCommand::class,
            PhpunitMakeCommand::class,
            StyleciMakeCommand::class,
            CodecovMakeCommand::class,
            ComposerMakeCommand::class,
            BaseTestMakeCommand::class,
            GitignoreMakeCommand::class,
            ContributionMakeCommand::class,
        ];
    }

    /**
     * Get package internal related commands.
     *
     * @return array
     */
    protected function packageInternalCommands()
    {
        return [
            Replace::class,
            AddPackage::class,
            ClonePackage::class,
            PackageMakeCommand::class,
            SavePackageCredentials::class,
            DeletePackageCredentials::class,
        ];
    }

    /**
     * Get package routing related commands.
     *
     * @return array
     */
    protected function routingCommands()
    {
        return [
            ControllerMakeCommand::class,
            MiddlewareMakeCommand::class,
        ];
    }

    /**
     * Get standard related commands.
     *
     * @return array
     */
    protected function standardCommands()
    {
        return [
            AnyMakeCommand::class,
            TraitMakeCommand::class,
            ContractMakeCommand::class,
            InterfaceMakeCommand::class,
        ];
    }
}
