<?php 	

/**
* 
*/

namespace Barbosa\Packager;

use Barbosa\Packager\ServicesContainer as Services;

class AccessFacade
{
	public static function __callStatic($method, $arguments)
	{	
		try {
			$service = Services::getService(static::getServiceName());
			if (method_exists($service, $method)) {
				$service->$method($arguments);
			} else {
				throw new \ErrorException("Method is not exists\n", 1);
			}
		} catch (\ErrorException $e) {
			echo $e->getMessage();
		}
	}
}