# HackPack: This package allows calling classes in function style, through the use of a PHP hack.

## Installation

To install via composer (http://getcomposer.org/), place the following in your composer.json file:

    {
        "require": {
            "barbosa/hackpack": "dev-master"
        }
    }

or download package from github.com:

    http://github.com/barbosa89/hackpack

## Configuration

Consider the following folder structure:

    /project
        /src
            MainClass.php
            Router.php
            TextProcessing.php
            Request.php
            services.php
        /test

The services.php file, returns an array with an alias and the corresponding namespace and the following sintax: 
    
    <?php 

    /**
     * file: services.php
     */

    return [

        'router' => Some\Namespace\Router::class,
        'text' => Some\Namespace\TextProcessing::class,
        'request' => Some\Namespace\Request::class  

    ];

In the MainClass.php file, invoke to **ServiceLoader::load()** method:
    
    <?php

    namespace Some\Namespace;

    use Barbosa\HackPack\ServiceLoader;

    class MainClass
    {
        public function __construct
        {
            $services = require 'services.php';
            ServiceLoader::load($services);
        }
    }

The **ServiceLoader::load()** method loads the objects in function style, wich are available in the application.

Now you can invoke services in functions style from anywhere in the application. Example: 

    <?php

    namespace Some\Namespace;

    use Barbosa\HackPack\ServiceLoader;

    class MainClass
    {
        public function __construct
        {
            $aliases = require 'services.php';
            ServiceLoader::load($services);
        }

        public function resolveUri($uri)
        {
            return request()->parseUri($uri);
        }
    }

The object name in function style, depends on the name assigned in the array. This is an alternative 
to [Packager Library](http://github.com/barbosa89/packager).

## Examples

    # Pass parameters to the constructor
    request($uri)->parseUri();

    # Pass parameters to methods
    request()->parseUri($uri);

    # Chaining of methods
    request()->parseUri($uri)->getResult();

## Contribute
1. Check for open issues or open a new issue to start a discussion around a bug or feature.
2. Fork the repository on GitHub to start making your changes.
3. Write one or more tests for the new feature or that expose the bug.
4. Make code changes to implement the feature or fix the bug.
5. Send a pull request to get your changes merged and published.

Thanks...

### [Omar Andrés Barbosa](http://omarbarbosa.com)