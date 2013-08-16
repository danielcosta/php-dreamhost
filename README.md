PHP class for the Dreamhost API
===============================

Interfaces with the Dreamhost API

Installation
------------

Package available on [Composer](http://packagist.org/packages/danielcosta/php-dreamhost). Autoloading is [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) compatible.

Usage
-----
	
	<?php
	
	use DanielCosta\Dreamhost;

    $dh = new Dreamhost('your api key'[,format]);
    $dh->exec('command'[, array(arg => value[, ...])]);

Where *__'command'__* is one of the many listed on the [Dreamhost Wiki API](http://wiki.dreamhost.com/API/Api_commands) article.

Method *__'exec'__* returns either an array of associative arrays of the data returned by Dreamhost or throws an exception upon error.

You can define any preferred return format by passing a second argument to class constructor. Defaults to 'json'.

Example
-------

	<?php
	
	use DanielCosta\Dreamhost;
    
    $dh = new Dreamhost('6SHU5P2HLDAYECUM'[,format]);

    try {
        $commands = $dh->exec('api-list_accessible_cmds');
        // $commands = $dh->api-list_accessible_cmds(); // this should also work
        print_r($commands);
    } catch (Exception $e) {
        echo $e->getMessage(); // contains either the error data returned by dreamhost or a curl error string and number
    }