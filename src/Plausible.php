<?php

namespace NjoguAmos\Plausible;

use NjoguAmos\Plausible\Connectors\PlausibleConnector;
use NjoguAmos\Plausible\Requests\GetAggregates;
use NjoguAmos\Plausible\Requests\GetRealtimeVisitors;
use NjoguAmos\Plausible\Requests\GetTimeSeries;

class Plausible
{
    protected PlausibleConnector $connector;

    public function __construct()
    {
        $this->connector = new PlausibleConnector();
    }

    public function realtime()
    {
        return $this->connector->send(new GetRealtimeVisitors())->body();
    }

    public function aggregates(
        ?string $period = '30d',
        array $metrics = [],
        bool $compare = true,
        array $filters = [],
        ?string $date = null,
    ) {
        $request = new GetAggregates(
            period: $period,
            metrics: $metrics ?: config(key: 'plausible.allowed_metrics.default'),
            compare: $compare,
            filters: $filters,
            date: $date ?: now()->format(format: 'Y-m-d'),
        );

        return $this->connector->send($request)->json('results');
    }

    public function timeSeries(
        ?string $period = '30d',
        array $metrics = [],
        string $interval = 'date',
        array $filters = [],
        ?string $date = null,
    ) {
        $request = new GetTimeSeries(
            period: $period,
            metrics: $metrics ?: config(key: 'plausible.allowed_metrics.time-series'),
            filters: $filters,
            interval: $interval,
            date: $date ?: now()->format(format: 'Y-m-d'),
        );

        return $this->connector->send($request)->json('results');
    }
}
