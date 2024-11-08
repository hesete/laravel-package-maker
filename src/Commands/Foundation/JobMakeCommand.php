<?php

namespace Hesete\LaravelPackageMaker\Commands\Foundation;

use Illuminate\Foundation\Console\JobMakeCommand as MakeJob;
use Hesete\LaravelPackageMaker\Traits\CreatesPackageStubs;
use Hesete\LaravelPackageMaker\Traits\HasNameInput;

class JobMakeCommand extends MakeJob
{
    use CreatesPackageStubs, HasNameInput;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'package:job';

    /**
     * Get the destination class path.
     *
     * @return string
     */
    protected function resolveDirectory()
    {
        return $this->getDirInput().'src';
    }
}
