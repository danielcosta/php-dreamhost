PHP class for the Dreamhost API
===============================

Interfaces with the Dreamhost API

Usage
-----

    $api = new Dreamhost('your api key');
    $api->exec('command'[, array(arg => value[, ...])]);

Where command is one of the many listed on the Dreamhost Wiki API article.

'exec' returns either an array of associative arrays of the data returned by Dreamhost or throws an exception upon error.

Example
-------

    $api = new Dreamhost('your api key');
    $cmd = "api-list_accessible_cmds";
    try {
        print_r($api->exec($cmd));
        // print_r($api->$cmd()); // this would also work
    } catch (Exception $e) {
        echo $e->getMessage(); // contains either the error data returned by dreamhost or a curl error string and number
    }