<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

class ViewMakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:view';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new blade template';
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $files;
    /**
     * Create a new command instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }
    /**
     * Handle command.
     */
    public function fire()
    {
        return $this->makeView();
    }
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'View path.']
        ];
    }
    /**
     * Make view file path.
     *
     * @param string $view
     * @return string
     */
    public function getPath($view)
    {
        return './resources/views/' . str_replace('.', '/', $view) . '.blade.php';
    }
    /**
     * Generate the blade file.
     */
    public function makeView()
    {
        $view = $this->argument('name');
        if ($this->files->exists($path = $this->getPath($view))) {
            return $this->error($path . ' already exists!');
        }
        $this->makeDirectory($path);

        $content = $path;
        if(strpos($path, "back") > 0 && strpos($path, "index") > 0)
            $content = \File::get(__DIR__."/stubs/views_back_index.stub");
        if(strpos($path, "back") > 0 && strpos($path, "create") > 0)
            $content = \File::get(__DIR__."/stubs/views_back_create.stub");
        if(strpos($path, "back") > 0 && strpos($path, "edit") > 0)
            $content = \File::get(__DIR__."/stubs/views_back_edit.stub");
        
        $this->files->put($path, $content);
        $this->info("View $path created successfully.");
    }
    /**
     * Build the directory for the view if necessary.
     *
     * @param $path
     */
    private function makeDirectory($path)
    {
        $dir = dirname($path);
        if (!$this->files->isDirectory($dir)) {
            $this->files->makeDirectory($dir, 0755, true, true);
        }
    }
}