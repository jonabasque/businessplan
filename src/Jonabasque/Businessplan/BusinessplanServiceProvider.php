<?php namespace Jonabasque\Businessplan;

use Illuminate\Support\ServiceProvider;

class BusinessplanServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		//Load views from package
		$this->loadViewsFrom(dirname(dirname(__DIR__)).'/views', 'Jonabasque/Businessplan');
		require_once __DIR__.'/../../routes.php';

		require_once __DIR__.'/../../../libs/business_plan/movement.php';
		require_once __DIR__.'/../../../libs/business_plan/inversion.php';
		require_once __DIR__.'/../../../libs/business_plan/human_resource.php';
		require_once __DIR__.'/../../../libs/business_plan/results.php';
		require_once __DIR__.'/../../../libs/business_plan/business_plan.php';
		require_once __DIR__.'/../../../libs/business_plan/fiscal_year.php';

		$this->publishes([
    	__DIR__.'/../../../public/assets/' => public_path('assets/jonabasque/businessplan'),
		], 'public');

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
