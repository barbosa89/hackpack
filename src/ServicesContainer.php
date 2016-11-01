<?php 

/**
 * ServiceContainer
 * Stores and manages the registered services
 * 
 * @package		Packager
 * @subpackage	ServicesContainer
 * @license    	http://www.gnu.org/licenses/gpl.txt  GNU GPL 3.0
 * @author     	Omar Andrés Barbosa Ortiz
 * @link       	www.omarbarbosa.com
 *
 */

namespace Barbosa\Packager;

use Barbosa\Packager\AliasLoader;

class ServicesContainer
{
	/**
	 * $services Services array with a identifier
	 * 
	 * @var array
	 */
	private $services = [];

	/**
	 * __construct Invokes to loadService method
	 */
	public function __construct()
	{
		$this->loadServices();
	}

	/**
	 * loadServices get Aliases array and invokes to setServices method
	 */
	private function loadServices()
	{
		try {
			$services = AliasLoader::getAliases();
			if (!empty($services)) {
				$this->setServices($services);
			} else {
				throw new \ErrorException("The aliases array not can be loaded.\n", 1);
			}	

		} catch (\ErrorException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * setServices 
	 * 
	 * @param array $services Aliases array
	 */
	private function setServices($services)
	{
		foreach ($services as $name => $service) {
			$this->services[$name] = $service;	
		}
	}

	/**
	 * getServiceInstance Return a instance of the required service
	 * 
	 * @param  string $serviceName Services identifier or alias
	 * @return object Service instance
	 */
	public function getServiceInstance($serviceName)
	{
		if (array_key_exists($serviceName, $this->services)) {
			if (class_exists($this->services[$serviceName])) {
				return new $this->services[$serviceName];
			} 

			throw new \ErrorException("The namespace class is not exists\n", 1);
		} 

		throw new \ErrorException("The {$serviceName} service was not loaded\n", 1);
	}

	/**
	 * getService Creates a self instance
	 * 
	 * @param  string $service Services identifier or alias
	 * @return object Service instance
	 */
	public static function getService($service) 
	{
		try {
			$container = new ServicesContainer();
			
			return $container->getServiceInstance($service);
		
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * getServiceReflection Get a reflection of the required service
	 * 
	 * @param  object $service Service instance
	 * @param  string $method  Invoked method
	 * @return object Reflection service
	 */
	public static function getServiceReflection($service, $method) 
	{
		return new \ReflectionMethod($service, $method);
	}
}