<?php

namespace Hesete\LaravelPackageMaker\Commands\Foundation;

use Illuminate\Foundation\Console\RuleMakeCommand as MakeRule;
use Hesete\LaravelPackageMaker\Traits\CreatesPackageStubs;
use Hesete\LaravelPackageMaker\Traits\HasNameInput;

class RuleMakeCommand extends MakeRule
{
    use CreatesPackageStubs, HasNameInput;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'package:rule';

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
