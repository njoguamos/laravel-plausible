<?php

namespace NjoguAmos\Plausible\Tests;

use NjoguAmos\Plausible\PlausibleServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            PlausibleServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('plausible.site_id', 'dealersyard.com');
        config()->set('plausible.api_key', 'dbNSKCE1b5rASiYgpPzQ4bC92WZw4xVS97bF_JQFHARlVtu26RUk2DMVCL5L4iNY');
    }
}
