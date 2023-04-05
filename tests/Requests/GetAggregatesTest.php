<?php

use NjoguAmos\Plausible\Connectors\PlausibleConnector;
use NjoguAmos\Plausible\Requests\GetAggregates;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it(description: 'it can get aggregates', closure: function () {
    $url = 'plausible.io/api/v1/stats/aggregates';

    $responseData = [
        "results" => [
            "bounce_rate"     => ["value" => 53.0, "change" => 12.4],
            "pageviews"       => ["value" => 673814, "change" => -12],
            "visit_duration"  => ["value" => 86.0, "change" => 150],
            "views_per_visit" => ["value" => 2.6, "change" => -30],
            "visits"          => ["value" => 21412, "change" => 200],
            "visitors"        => ["value" => 201524, "change" => 2],
            "events"          => ["value" => 2423, "change" => -5]
        ]
    ];

    $mockClient = new MockClient([
        $url => MockResponse::make($responseData, 200),
    ]);

    $plausible = new PlausibleConnector();
    $plausible->withMockClient($mockClient);

    $response = $plausible->send(new GetAggregates());

    expect($response->body())->toBe($responseData['results']);
});

test(description: 'it throws an error when invalid period is provided', closure: function () {
    $plausible = new PlausibleConnector();

    $plausible->send(new GetAggregates(period: '24mo'));
})->throws(exception: RuntimeException::class);

test(description: 'it throws an error when invalid metric is provided', closure: function () {
    $plausible = new PlausibleConnector();

    $plausible->send(new GetAggregates(metrics: ['new_visits']));
})->throws(exception: RuntimeException::class);
