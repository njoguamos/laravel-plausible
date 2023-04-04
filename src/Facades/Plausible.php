<?php

namespace NjoguAmos\Plausible\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NjoguAmos\Plausible\Plausible
 */
class Plausible extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \NjoguAmos\Plausible\Plausible::class;
    }
}
