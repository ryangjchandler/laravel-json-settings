# Store your Laravel application settings in an on-disk JSON file.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ryangjchandler/laravel-json-settings.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/laravel-json-settings)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ryangjchandler/laravel-json-settings/run-tests?label=tests)](https://github.com/ryangjchandler/laravel-json-settings/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ryangjchandler/laravel-json-settings/Check%20&%20fix%20styling?label=code%20style)](https://github.com/ryangjchandler/laravel-json-settings/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ryangjchandler/laravel-json-settings.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/laravel-json-settings)

This package provides a simple `SettingsRepository` class that can be used to store your application's settings in a single JSON file.

## Installation

You can install the package via composer:

```bash
composer require ryangjchandler/laravel-json-settings
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-json-settings-config"
```

## Usage

You can resolve an instance of `RyanChandler\LaravelJsonSettings\SettingsRepository` from the container by type-hinting it in any DI-supported method, e.g. a controller method.

```php
class IndexController
{
    public function __invoke(SettingsRepository $settings)
    {
        return view('index', [
            'title' => $settings->get('index.title'),
        ]);
    }
}
```

The `SettingsRepository` class contains the following methods:

* `get(string $key, mixed $default = null)` - retrieve the value of a setting by providing the key (dot-notation supported).
* `set(string $key, mixed $value, bool $save = true)` - set the value of a setting and toggle auto-save.
* `has(string $key)` - determine if a setting exists.
* `save()` - manually save your settings back to disk.
* `reload()` - clear the cache and reload the settings from disk.

If you prefer to use facades, you can interact with the `RyanChandler\LaravelJsonSettings\Facades\Settings` facade directly too.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ryan Chandler](https://github.com/ryangjchandler)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
