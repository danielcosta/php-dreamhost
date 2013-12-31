PHP class for the Dreamhost API [![Build Status](https://travis-ci.org/danielcosta/php-dreamhost.png?branch=master)](https://travis-ci.org/danielcosta/php-dreamhost)
===============================

Interfaces with the Dreamhost API

Installation
------------

Autoloading is [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) compatible.

- [API on Packagist] (https://packagist.org/packages/danielcosta/php-dreamhost)
- [API on GitHub] (https://github.com/danielcosta/php-dreamhost)

To get the latest version of php-dreamhost just require it in your `composer.json` file like so.

~~~
"danielcosta/php-dreamhost": "dev-master"
~~~

You will then need to run `composer install` to download it and have the autoloader updated.

Once php-dreamhost is installed you will need to register the service provider with the application.  Open up `app/config/app.php` and find the `providers` key.

~~~
'providers' => array(

    # Existing providers...
    'DanielCosta\Dreamhost\DreamhostServiceProvider',

)
~~~

It also shiops with a facade which provides the static syntax for creating collections.  The facade is automatically registered for you as `Dreamhost`.

Publish the config using artisan CLI.

~~~
php artisan config:publish danielcosta/dreamhost
~~~

The config file is used to store the following options:

~~~
format => Default output format

api_url => Default DreamHost API URL

key => Default API key
~~~

Usage
-----
	
	<?php
	
	use DanielCosta\Dreamhost;

    $dh = new Dreamhost();
    $dh::cmdApi('command'[, array(arg => value[, ...])]);

Where *__'command'__* is one of the many listed on the [Dreamhost Wiki API](http://wiki.dreamhost.com/API/Api_commands) article.

Method *__'exec'__* returns either an array of associative arrays of the data returned by Dreamhost or throws an exception upon error.

You can define any preferred return format by passing a second argument to class constructor. Defaults to 'json'.

Example
-------

	<?php
	
	use DanielCosta\Dreamhost;
    
    $dh = new Dreamhost();

    try {
    	$method = 'api-list_accessible_cmds';
        $commands = $dh::cmdApi($method);
        $tmp = json_decode($commands, true);
        $result = $tmp['result'];
        $data = $tmp['data'];
        var_dump($data);
    } catch (Exception $e) {
        echo $e->getMessage(); // contains either the error data returned by dreamhost or a curl error string and number
    }

    echo $dh::getHttpCode();  // HTTP response code

    echo $dh::getHttpInfo();  // HTTP header information

    echo $dh::getErroNumber();  // cURL error number, if any

    echo $dh::getError();  // cURL error message, if any
