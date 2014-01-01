<?php namespace DanielCosta\Dreamhost\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Dreamhost
 *
 * @package DanielCosta\Dreamhost
 * @author  Daniel Costa <danielcosta@gmail.com>
 * @version 2.0.0
 */
class Dreamhost extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dreamhost';
    }
}
