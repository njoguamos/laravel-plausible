<?php

use NjoguAmos\Plausible\Connectors\PlausibleConnector;
use NjoguAmos\Plausible\Requests\GetRealtimeVisitors;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it(description: 'it can get realtime visitors', closure: function () {
    $url = 'plausible.io/api/v1/stats/realtime/visitors';

    $mockClient = new MockClient([
        $url => MockResponse::make('23', 200),
    ]);

    $plausible = new PlausibleConnector();
    $plausible->withMockClient($mockClient);

    $response = $plausible->send(new GetRealtimeVisitors());

    expect((int) $response->body())->toBe(23);
});
