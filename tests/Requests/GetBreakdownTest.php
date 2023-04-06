<?php

use NjoguAmos\Plausible\Connectors\PlausibleConnector;
use NjoguAmos\Plausible\Requests\GetBreakDown;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it(description: 'it can get breakdown', closure: function () {
    $url = 'plausible.io/api/v1/*';

    $responseData = [
        ["bounce_rate" => 52, "page" => "/", "pageviews" => 72, "visit_duration" => 147, "visitors" => 31, "visits" => 27],
        ["bounce_rate" => 78, "page" => "/blog", "pageviews" => 16, "visit_duration" => 25, "visitors" => 15, "visits" => 9],
        ["bounce_rate" => 100, "page" => "/pricing", "pageviews" => 9, "visit_duration" => 0, "visitors" => 9, "visits" => 1],
        ["bounce_rate" => 90, "page" => "/blog/about-plausible", "pageviews" => 12, "visit_duration" => 29, "visitors" => 9, "visits" => 10],
        ["bounce_rate" => 75, "page" => "/contact-us", "pageviews" => 9, "visit_duration" => 178, "visitors" => 7, "visits" => 4]
    ];

    $mockClient = new MockClient([
        $url => MockResponse::make($responseData, 200),
    ]);

    $plausible = new PlausibleConnector();
    $plausible->withMockClient($mockClient);

    $response = $plausible->send(new GetBreakDown());

    expect($response->body())->toBe(json_encode($responseData));
});

test(description: 'it throws an error when invalid period is provided', closure: function () {
    $plausible = new PlausibleConnector();

    $plausible->send(new GetBreakDown(period: '24mo'));
})->throws(exception: RuntimeException::class);

test(description: 'it throws an error when invalid metric is provided', closure: function () {
    $plausible = new PlausibleConnector();

    $plausible->send(new GetBreakDown(metrics: ['new_visits']));
})->throws(exception: RuntimeException::class);
