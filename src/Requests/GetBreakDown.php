<?php

namespace NjoguAmos\Plausible\Requests;

use RuntimeException;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetBreakDown extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        public string $property = 'event:page',
        public string $period = '30d',
        public ?string $date = null,
        public array $metrics = [],
        public int $limit = 100,
        public int $page = 1,
        public array $filters = [],
    ) {

        if (! in_array(needle: $this->property, haystack: config(key: 'plausible.allowed_properties'))) {
            throw new RuntimeException(message: trans(key: 'plausible::plausible.invalid_property'));
        }

        if (! in_array(needle: $this->period, haystack: config(key: 'plausible.allowed_periods'))) {
            throw new RuntimeException(message: trans(key: 'plausible::plausible.invalid_period'));
        }

        if (count(value: array_diff($this->metrics, config(key: 'plausible.allowed_metrics.time-series'))) !== 0) {
            throw new RuntimeException(message: trans(key: 'plausible::plausible.invalid_metric'));
        }
    }

    public function resolveEndpoint(): string
    {
        return '/breakdown';
    }

    protected function defaultQuery(): array
    {
        $query = [
            'property' => $this->property,
            'period'   => $this->period,
            'limit'    => $this->limit,
            'page'     => $this->page,
        ];

        if (!empty($this->metrics)) {
            $query['metrics'] = $this->getMetrics();
        }

        if (!empty($this->filters)) {
            $query['filters'] = $this->getFilters();
        }

        if ($this->date) {
            $query['date'] = $this->date;
        }

        return $query;
    }

    protected function getMetrics(): string
    {
        return implode(separator: ',', array: $this->metrics);
    }

    protected function getFilters(): string
    {
        return implode(separator: ';', array: $this->filters);
    }
}
