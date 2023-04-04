<?php

namespace NjoguAmos\Plausible\Commands;

use Illuminate\Console\Command;

class PlausibleCommand extends Command
{
    public $signature = 'laravel-plausible';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
