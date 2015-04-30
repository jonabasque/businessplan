<?php 

namespace Jonabasque\Businessplan;

/**
 * 
 * @author jonabasque <jonmultimedia@gmail>
 */
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
class BusinessplanServiceProvider extends ServiceProvider{
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
		echo "Mensaje de prueba";
	}

}