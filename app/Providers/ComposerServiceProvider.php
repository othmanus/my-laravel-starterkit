<?php namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {

        // Partager les configurations
        View::composer('*', 'App\Http\ViewComposers\Setting\SettingComposer');


    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
        //
    }

}