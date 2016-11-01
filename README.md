# Packager: This package allows to classes invoke static style, using pseudo facade classes.

## Installation

To install via composer (http://getcomposer.org/), place the following in your composer.json file:

    {
        "require": {
            "barbosa/packager": "dev-master"
        }
    }

or download package from github.com:

    http://github.com/barbosa89/packager

## Configuration

Consider the following folder structure:

    /project
        /src
            MainClass.php
            Router.php
            TextProcessing.php
            Request.php
            services.php
            /Facades
                Router.php
                TextProcessing.php
                Request.php

In the services.php file, returns an array with an alias and the corresponding namespace and the following sintax: 
    
    <?php 

    /**
     * file: services.php
     */

    return [

        'router' => Some\Namespace\Router::class,
        'text' => Some\Namespace\TextProcessing::class,
        'request' => Some\Namespace\Request::class  

    ];

In the MainClass.php, invoke to **AliasLoader::setAliases** method:
    
    <?php

    namespace Some\Namespace;

    use Barbosa\Packager\AliasLoader;

    class MainClass
    {
        public function __construct
        {
            $aliases = require 'services.php';
            AliasLoader::setAliases($aliases);
        }
    }

The **AliasLoader::setAliases** method used to record the namespaces and can be called from anywhere in the application.

The facades classes must be created in the folder Facades:

    <?php

    namespace Some\Namespace\Facade;

    use Barbosa\Packager\AccessFacade;
    use Barbosa\Packager\FacadeInterface;

    class Router extends AccessFacade implements FacadeInterface
    {
        public static function getServiceName()
        {
            return 'router';
        }
    }

For each service or class, it must be created a facade.

Now you can invoke static style services from anywhere in the application, just by using the namespace of the facade. Example: 

    <?php

    namespace Some\Namespace;

    use Barbosa\Packager\AliasLoader;
    use Some\Namespace\Facades\Request

    class MainClass
    {
        public function __construct
        {
            $aliases = require 'services.php';
            AliasLoader::setAliases($aliases);
        }

        public function resolveUri($uri)
        {
            return Request::parseUri($uri);
        }
    }

## Credits
- www.sitepoint.com
- Inspired by Laravel: Facade class


## Contribute
1. Check for open issues or open a new issue to start a discussion around a bug or feature.
2. Fork the repository on GitHub to start making your changes.
3. Write one or more tests for the new feature or that expose the bug.
4. Make code changes to implement the feature or fix the bug.
5. Send a pull request to get your changes merged and published.

Thanks...

### [Omar Andrés Barbosa](http://omarbarbosa.com)