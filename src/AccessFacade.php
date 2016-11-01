<?php 	

/**
 *
 * AccessFacade
 * Invokes a class in static style.
 *
 * @package		Packager
 * @subpackage	AccessFacade
 * @license    	http://www.gnu.org/licenses/gpl.txt  GNU GPL 3.0
 * @author     	Omar Andrés Barbosa Ortiz
 * @link       	http://omarbarbosa.com
 *
 */

namespace Barbosa\Packager;

use Barbosa\Packager\ServicesContainer as Services;

class AccessFacade
{

    /**
     * __callStatic method
     * Invokes a class in static style. 
     *
     * @param string $method Method name
     * @param array $arguments Method parameters 
     * @return object Invoked object
     */
	public static function __callStatic($method, $arguments)
	{	
		try {
			$service = Services::getService(static::getServiceName());
			
			if (is_object($service) and method_exists($service, $method)) {
				$reflection = Services::getServiceReflection($service, $method);
			
				return $reflection->invokeArgs($service, $arguments);
				
			} else {
				throw new \ErrorException("Packager: Method is not exists\n", 1);
			}
		} catch (\ErrorException $e) {
			echo $e->getMessage();
		}
	}
}