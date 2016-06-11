<?php

namespace App\Console\Commands;

use Illuminate\Support\Composer;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\GeneratorCommand;

class PresenterMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:presenter {name} {--imageable}';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:presenter {name} {--imageable}';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make new presenter class (based on laracast package)';


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/presenter'.($this->option('imageable') ? '_imageable' : '').'.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Presenters';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'Name of the new presenter class'),
        );
    }
}
