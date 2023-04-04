<?php

namespace NjoguAmos\Plausible\Connectors;

use Saloon\Http\Connector;

class PlausibleConnector extends Connector
{
    public function __construct()
    {
        $this->withTokenAuth(token: config(key: 'plausible.api_key'));
    }

    public function resolveBaseUrl(): string
    {
        return 'https://plausible.io/api/v1/stats';
    }

    public function defaultConfig(): array
    {
        return [
            'timeout' => 150,
        ];
    }

    protected function defaultQuery(): array
    {
        return [
            'site_id' => config(key: 'plausible.site_id'),
        ];
    }
}
