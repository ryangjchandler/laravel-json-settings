<?php

namespace RyanChandler\LaravelJsonSettings\Facades;

use Illuminate\Support\Facades\Facade;
use RyanChandler\LaravelJsonSettings\SettingsRepository;

/**
 * @method static mixed get(string $key, mixed $default = null)
 * @method static static set(string $key, mixed $value, bool $save = true)
 * @method static bool has(string $key)
 * @method static static reload()
 * @method static static save()
 *
 * @see \RyanChandler\LaravelJsonSettings\SettingsRepository
 */
class Settings extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SettingsRepository::class;
    }
}
