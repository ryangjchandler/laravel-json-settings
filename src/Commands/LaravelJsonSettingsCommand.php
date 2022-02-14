<?php

namespace RyanChandler\LaravelJsonSettings\Commands;

use Illuminate\Console\Command;

class LaravelJsonSettingsCommand extends Command
{
    public $signature = 'laravel-json-settings';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
