<?php 

use Barbosa\Packager\ServicesContainer;
use Barbosa\Packager\AliasLoader;

class ServicesContainerTest extends PHPUnit_Framework_TestCase
{

	public function setUp()
	{
		$this->service = 'router';
		$this->aliases = ['router' => Barbosa\Packager\Simulations\Router::class];
	}

	public function tearDown()
	{
		$this->service = '';
		$this->aliases = [];
	}

	public function testIsInstanceOfRouter()
	{
		AliasLoader::setAliases($this->aliases);
		$this->coverage = new ServicesContainer();
		$service = $this->coverage->getServiceInstance($this->service);
		$this->assertInstanceOf(Barbosa\Packager\Simulations\Router::class, $service);
	}

	public function testIsNotInstanceOfRequest()
	{
		AliasLoader::setAliases($this->aliases);
		$this->coverage = new ServicesContainer();
		$service = $this->coverage->getServiceInstance($this->service);
		$this->assertNotInstanceOf(Barbosa\Packager\Simulations\Request::class, $service);
	}
}