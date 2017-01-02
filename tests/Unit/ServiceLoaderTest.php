<?php 

use Barbosa\HackPack\ServiceLoader;

class ServiceLoaderTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->aliases = [
            'router' => Barbosa\HackPack\Simulations\Router::class,
            'request' => Barbosa\HackPack\Simulations\Request::class,
            'user' => Barbosa\HackPack\Simulations\User::class
        ];
        
        ServiceLoader::load($this->aliases);
    }

    public function tearDown()
    {
        $this->aliases = []; 
    }

    public function testIsInstanceOfRouter()
    {
        $this->assertInstanceOf(Barbosa\HackPack\Simulations\Router::class, router());
    }

    public function testIsInstanceOfRequest()
    {
        $this->assertInstanceOf(Barbosa\HackPack\Simulations\Request::class, request());
    }
    
    /**
     * @expectedException Exception
     */
    public function testExceptionIsThrownClassIsNotExist()
    {
        ServiceLoader::load(['router' => Barbosa\HackPack\Simulations\Other::class]);
        $this->expectException(Exception::class);
    }
    
    public function testRequestClassMethodReturnString()
    {
        $this->assertEquals('Resolved', request()->resolveUri());
    }
    
    public function testRouterClassReturnsParameterAssignedByConstructor()
    {
        $this->assertEquals('users/edit/2', router('users/edit/2')->getUri());
    }
    
    public function testUserClassInvokeGetDataMethod()
    {
        $this->assertEquals(
            ['email' => 'mail@mail.com'], 
            user('MyName', ['email' => 'mail@mail.com'])->getData()
        );
    }

    public function testUserClassWithEmptyAttribute()
    {
        $this->assertEquals('', user()->getName());
    }   
}