<?php

use NjoguAmos\Plausible\Connectors\PlausibleConnector;
use NjoguAmos\Plausible\Requests\GetTimeSeries;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it(description: 'it can get time series data', closure: function () {
    $url = 'plausible.io/api/v1/*';

    $responseData = [
        "results" => [
            [
                "bounce_rate"     => 17,
                "date"            => "2023-01-01",
                "pageviews"       => 60,
                "views_per_visit" => 19,
                "visit_duration"  => 525,
                "visitors"        => 6,
                "visits"          => 6
            ],
            [
                "bounce_rate"     => 12,
                "date"            => "2023-01-02",
                "pageviews"       => 22,
                "views_per_visit" => 4,
                "visit_duration"  => 149,
                "visitors"        => 6,
                "visits"          => 8
            ]
        ]
    ];

    $mockClient = new MockClient([
        $url => MockResponse::make($responseData, 200),
    ]);

    $plausible = new PlausibleConnector();
    $plausible->withMockClient($mockClient);

    $response = $plausible->send(new GetTimeSeries());

    expect($response->body())->toBe(json_encode($responseData));
});

test(description: 'it throws an error when invalid period is provided', closure: function () {
    $plausible = new PlausibleConnector();

    $plausible->send(new GetTimeSeries(period: '24mo'));
})->throws(exception: RuntimeException::class);

test(description: 'it throws an error when invalid metric is provided', closure: function () {
    $plausible = new PlausibleConnector();

    $plausible->send(new GetTimeSeries(metrics: ['new_visits']));
})->throws(exception: RuntimeException::class);

test(description: 'it throws an error when invalid interval is provided', closure: function () {
    $plausible = new PlausibleConnector();

    $plausible->send(new GetTimeSeries(interval: 'year'));
})->throws(exception: RuntimeException::class);
