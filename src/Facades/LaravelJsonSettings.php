<?php

namespace RyanChandler\LaravelJsonSettings\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RyanChandler\LaravelJsonSettings\LaravelJsonSettings
 */
class LaravelJsonSettings extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-json-settings';
    }
}
