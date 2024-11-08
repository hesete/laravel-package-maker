<?php

namespace Hesete\LaravelPackageMaker\Commands\Foundation;

use Illuminate\Foundation\Console\ConsoleMakeCommand as MakeConsole;
use Hesete\LaravelPackageMaker\Traits\CreatesPackageStubs;
use Hesete\LaravelPackageMaker\Traits\HasNameInput;

class ConsoleMakeCommand extends MakeConsole
{
    use CreatesPackageStubs, HasNameInput;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'package:command';

    /**
     * Get the destination class path.
     *
     * @return string
     */
    protected function resolveDirectory()
    {
        return $this->getDirInput().'src';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Commands';
    }
}
