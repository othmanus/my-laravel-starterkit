<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand;
use Str;

class ModuleMakeCommand extends ModelMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name} {--migration} {--imageable}';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:module {name} {--migration} {--imageable}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new MVC Module.';

    
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Module';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $name = $this->argument('name');

        if (parent::fire() !== false) {
            $namespace = class_basename($name).'\\';
            
            // create migration
            $table = Str::plural(Str::snake(class_basename($name)));
            
            $this->call('make:migration', ['name' => "create_{$table}_table", '--create' => $table]);
    
            // create request
            $this->call('make:request-admin', ['name' => $namespace.$name.'StoreRequest']);
            $this->call('make:request-admin', ['name' => $namespace.$name.'UpdateRequest']);
            // create back office views
            $this->call('make:view', ['name' => 'back.'.$table.'.index']);
            $this->call('make:view', ['name' => 'back.'.$table.'.create']);
            $this->call('make:view', ['name' => 'back.'.$table.'.edit']);
            // create front office views            
            $this->call('make:view', ['name' => 'front.'.$table.'.index']);
            $this->call('make:view', ['name' => 'front.'.$table.'.show']);
            
            // create controller & presenter
            $controller_name = $namespace.Str::plural(class_basename($name)).'Controller';
            if($this->option('imageable')) {
                // create controller
                $this->call('make:resourceful_controller', ['name' => $controller_name, '--imageable' => true]);
                // create presenter
                $this->call('make:presenter', ['name' => $namespace.$name.'Presenter', '--imageable' => true]);

            } else {
                // create controller
                $this->call('make:resourceful_controller', ['name' => $controller_name]);
                // create presenter
                $this->call('make:presenter', ['name' => $namespace.$name.'Presenter']);
            }

            
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/model'.($this->option('imageable') ? '_imageable' : '').'.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $name = class_basename($this->argument('name'));

        return $rootNamespace."\\Models\\".$name;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'Name of the new module (without namespace)'),
        );
    }
}
