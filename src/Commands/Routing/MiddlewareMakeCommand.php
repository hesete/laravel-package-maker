<?php

namespace Hesete\LaravelPackageMaker\Commands\Routing;

use Illuminate\Routing\Console\MiddlewareMakeCommand as MakeMiddleware;
use Hesete\LaravelPackageMaker\Traits\CreatesPackageStubs;
use Hesete\LaravelPackageMaker\Traits\HasNameInput;

class MiddlewareMakeCommand extends MakeMiddleware
{
    use CreatesPackageStubs, HasNameInput;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'package:middleware';

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
