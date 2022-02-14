<?php

namespace RyanChandler\LaravelJsonSettings;

use Illuminate\Cache\TaggedCache;
use Illuminate\Contracts\Cache\Repository;
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

    public function set(string $key, mixed $value, bool $save = true): static
    {
        Arr::set($this->settings, $key, $value);

        if ($save) {
            $this->save();
        }

        return $this;
    }

    public function has(string|array $keys): bool
    {
        return Arr::has($this->settings, $keys);
    }

    public function save(int $flags = 0): static
    {
        File::put($this->path, json_encode($this->settings, JSON_PRETTY_PRINT | $flags));

        $this->forget();

        return $this;
    }

    public function reload(): static
    {
        $this->forget();
        $this->load();

        return $this;
    }

    protected function forget(): void
    {
        $this->getCacheStore()->forget($this->getCacheKey());
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

    protected function getCacheStore(): TaggedCache|Repository
    {
        return $this->getCacheTag() ? Cache::tags($this->getCacheTag()) : Cache::store();
    }

    protected function load(): void
    {
        $this->settings = $this->getCacheStore()
            ->rememberForever($this->getCacheKey(), function () {
                return json_decode(File::get($this->path), true);
            });
    }
}
