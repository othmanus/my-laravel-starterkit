<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Setting\SettingService;
use App\Repositories\Setting\SettingRepository;

class SettingServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		
		$this->app->bind('setting', function() {
			return new SettingService;
		});
	}

}
