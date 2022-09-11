<?php

use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\assertFileExists;

use RyanChandler\LaravelJsonSettings\SettingsRepository;

it('can be resolved from the container', function () {
    expect(app(SettingsRepository::class))->toBeInstanceOf(SettingsRepository::class);
});

it('creates an empty json file if one does not exist', function () {
    File::delete(storage_path('settings.json'));

    $_ = app(SettingsRepository::class);

    assertFileExists(storage_path('settings.json'));
});

it('can read settings', function () {
    File::put(storage_path('settings.json'), json_encode([
        'foo' => 'bar',
    ]));

    expect(app(SettingsRepository::class))
        ->get('foo')
        ->toEqual('bar');
});

it('can write settings', function () {
    app(SettingsRepository::class)
        ->set('name', 'foo');

    expect(File::get(storage_path('settings.json')))
        ->toContain('"name": "foo"');
});
