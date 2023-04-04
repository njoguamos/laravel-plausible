<?php

namespace NjoguAmos\Plausible;

use NjoguAmos\Plausible\Connectors\PlausibleConnector;
use NjoguAmos\Plausible\Requests\GetRealtimeVisitors;

class Plausible
{
    public function realtime()
    {
        $plausible = new PlausibleConnector();

        $response = $plausible->send(new GetRealtimeVisitors());

        return $response->body();
    }
}
