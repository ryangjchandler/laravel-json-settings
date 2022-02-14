<?php

namespace RyanChandler\LaravelJsonSettings;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Traits\Macroable;

class SettingsRepository
{
    use Macroable;

    protected array $settings = [];

    public function __construct(
        protected string $path
    ) {
        if (! file_exists($this->path)) {
            File::put($this->path, json_encode([], JSON_PRETTY_PRINT | JSON_FORCE_OBJECT));
        }

        $this->load();
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return Arr::get($this->settings, $key, $default);
    }

    public function set(string $key, mixed $value, bool $save = true): void
    {
        Arr::set($this->settings, $key, $value);

        if ($save) {
            $this->save();
        }
    }

    public function has(string|array $keys): bool
    {
        return Arr::has($this->settings, $keys);
    }

    public function save(int $flags = 0): void
    {
        File::put($this->path, json_encode($this->settings, JSON_PRETTY_PRINT | $flags));

        Cache::forget($this->getCacheKey());
    }

    public function getPath(): string
    {
        return $this->path;
    }

    protected function getCacheKey(): string
    {
        return config('json-settings.cache.key');
    }

    protected function getCacheTag(): ?string
    {
        return config('json-settings.cache.tag');
    }

    protected function load(): void
    {
        $this->settings = ($this->getCacheTag() ? Cache::tags($this->getCacheTag()) : Cache::store())
            ->rememberForever($this->getCacheKey(), function () {
                return json_decode(File::get($this->path), true);
            });
    }
}
