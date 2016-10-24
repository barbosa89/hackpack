<?php 

namespace Barbosa\Packager;

use Barbosa\Packager\AliasLoader;

/**
 * @package		Packager
 * @subpackage	ServicesContainer
 * @license    	http://www.gnu.org/licenses/gpl.txt  GNU GPL 3.0
 * @author     	Omar Andrés Barbosa Ortiz
 * @link       	www.omarbarbosa.com
 *
 */
class ServicesContainer
{
	private static $services = [];

	public function __construct()
	{
		$this->loadServices();
	}

	private function loadServices()
	{
		try {
			var_dump(AliasLoader::getAliases());
			$services = AliasLoader::getAliases();
			if (!empty($services)) {
				$this->setServices($services);
			} else {
				throw new \ErrorException("The aliases file not can be loaded, please check the path.\n", 1);
			}	

		} catch (\ErrorException $e) {
			echo $e->getMessage();
		}
	}

	private function setServices($services)
	{
		foreach ($services as $name => $service) {
			self::$services[$name] = $service;	
		}
	}

	private function getServiceInstance($serviceName)
	{
		if (array_key_exists($serviceName, self::$services)) {
			if (class_exists(self::$services[$serviceName])) {
				return new self::$services[$serviceName];
			} 

			throw new \ErrorException("The namespace class is not exists\n", 1);
		} 

		throw new \ErrorException("The {$serviceName} service was not loaded\n", 1);
	}

	public static function getService($service) 
	{
		$container = new ServicesContainer();
		try {
			return $container->getServiceInstance($service);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}