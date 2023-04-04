<?php

namespace NjoguAmos\Plausible\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetRealtimeVisitors extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/realtime/visitors';
    }
}
