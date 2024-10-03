
# Plausible Analytics for Laravel 10+

[![Latest Version on Packagist](https://img.shields.io/packagist/v/njoguamos/laravel-plausible.svg?style=flat-square)](https://packagist.org/packages/njoguamos/laravel-plausible)
[![Total Downloads](https://img.shields.io/packagist/dt/njoguamos/laravel-plausible.svg?style=flat-square)](https://packagist.org/packages/njoguamos/laravel-plausible)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/njoguamos/laravel-plausible/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/njoguamos/laravel-plausible/actions?query=workflow%3Arun-tests+branch%3Amain)
![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/njoguamos/laravel-plausible/fix-php-code-style-issues.yml?label=code%20style)

[Plausible](https://plausible.io/) is intuitive, lightweight and open source web analytics. Plausible has no cookies and fully compliant with GDPR, CCPA and PECR.


## Installation

You can install the package via composer:

```bash
composer require njoguamos/laravel-plausible
```

You can initialise the package with:

```bash
php artisan plausible:install
```

Install command will publish the [config file](/config/plausible.php).

Ensure that you have updated your application `.env` with credentials from [Plausible](https://plausible.io/docs/stats-api) i.e.

```dotenv
#.env file

PLAUSIBLE_SITE_ID=
PLAUSIBLE_API_KEY=
#PLAUSIBLE_BASE_URL= <-- (Optional) for self-hosted
```

> *Note* If you are using a self-hosted version of plausible, ensure that you define `PLAUSIBLE_BASE_URL` to point to your custom domain.


## Usage

### 1. Getting Realtime Visitors

To get the current visitors on your default site, run a request as follows.

```php
use NjoguAmos\Plausible\Facades\Plausible;

$visitors = Plausible::realtime();
```
The response in a single digit number
```json
12
```

If you prefer using facades, then you can do as follows.

```php
use NjoguAmos\Plausible\Facades\Plausible;

$all = Plausible::aggregates();
```

### 2. Getting Aggregates

To get the aggregates, run a request as follows.

```php
use NjoguAmos\Plausible\Facades\Plausible;

// Simple with default
$aggregates = Plausible::aggregates();

// Or with optional custom parameters
$aggregates = Plausible::aggregates(
        period: 'custom',
        metrics: ['visitors', 'visits', 'pageviews'],
        filters: ['event:page==/blog**', 'visit:country==KE'],
        date: '2023-01-01,2023-01-31',
        withImported: true
    );
```
A successful response will be a json. Example;
```json
{
    "bounce_rate": {
        "change": 4,
        "value": 71
    },
    "events": {
        "change": -24,
        "value": 1166
    },
    "pageviews": {
        "change": -24,
        "value": 1166
    },
    "views_per_visit": {
        "change": -26,
        "value": 3
    },
    "visit_duration": {
        "change": -37,
        "value": 132
    },
    "visitors": {
        "change": 1,
        "value": 360
    },
    "visits": {
        "change": 3,
        "value": 389
    }
}
```

#### Aggregates parameters explained `expand to view more details`.

<details>
<summary>Period - string, optional</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::aggregates(period: '7d')
```
The `period` MUST be either of the allowed ones i.e `12mo`,`6mo`,`month`,`0d`,`7d`,`day`, or `custom`. If not provided, period will default to `30d`;
</details>

<details>
<summary>
    Metrics - array, optional
</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::aggregates(metrics: ['visitors', 'visits'])
```
The `metrics` must contain either of the allowed ones i.e `visitors`,`visits`,`pageviews`,`views_per_visit`,`bounce_rate`,`visit_duration`, or `events`. If not provided, all metrics will be included.
</details>

<details>
<summary>
    Compare - boolean, optional
</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::aggregates(compare: false )
```
`compare` defaults to `true`, meaning that the percent difference with the previous period for each metric will be calculated.
</details>


<details>
<summary>
    Filters - array, optional
</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::aggregates(filters: ['event:page==/blog**', 'visit:country==KE|DE'])
```
Your filters must be properly formed as per [plausible instructions](https://plausible.io/docs/stats-api#filtering). Filters defaults to `null`.
</details>

<details>
<summary>
    Date - string, optional
</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::aggregates(period: 'custom', date: '2023-01-01,2023-01-31')
```
Date in `Y-m-d` format. Individual date e.g `2023-01-04` or a range  `2023-01-01,2023-01-31`. When not provided, date defaults to `current date`.

>**Info**
> You must include `period: 'custom'` when you provide a date range.
</details>

### 3. Getting Time Series

To get the timeseries data over a certain time period, run a request as follows.

```php
use NjoguAmos\Plausible\Facades\Plausible;

// Simple with default
$aggregates = Plausible::timeSeries();

// Or with optional custom parameters
$aggregates = Plausible::timeSeries(
        period: 'custom',
        metrics: ['visitors', 'visits', 'pageviews', 'views_per_visit', 'bounce_rate', 'visit_duration'],
        filters: ['event:page==/blog**'],
        interval: 'month',
        date: '2023-01-01,2023-01-31'
    );
```
A successful response will be a json. Example;
```json
[
    {
        "bounce_rate": 17,
        "date": "2023-01-01",
        "pageviews": 60,
        "views_per_visit": 19,
        "visit_duration": 525,
        "visitors": 6,
        "visits": 6
    },
    {
        "bounce_rate": 12,
        "date": "2023-01-02",
        "pageviews": 22,
        "views_per_visit": 4,
        "visit_duration": 149,
        "visitors": 6,
        "visits": 8
    },
    {
        "bounce_rate": 57,
        "date": "2023-01-03",
        "pageviews": 9,
        "views_per_visit": 2.57,
        "visit_duration": 48,
        "visitors": 7,
        "visits": 7
    },
    {
        "bounce_rate": 71,
        "date": "2023-01-04",
        "pageviews": 48,
        "views_per_visit": 8.43,
        "visit_duration": 301,
        "visitors": 7,
        "visits": 7
    }
]
```

#### Timeseries parameters explained `expand to view more details`.

<details>
<summary>Period - string, optional</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::timeSeries(period: '6mo')
```
The `period` MUST be either of the allowed ones i.e `12mo`,`6mo`,`month`,`0d`,`7d`,`day`, or `custom`. If not provided, period will default to `30d`;
</details>

<details>
<summary>
    Metrics - array, optional
</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::timeSeries(metrics: ['visits', 'pageviews', 'views_per_visit'])
```
The `metrics` must contain either of the allowed ones i.e `visitors`,`visits`,`pageviews`,`views_per_visit`,`bounce_rate`,`visit_duration`, or `events`. If not provided, all metrics will be included.
</details>

<details>
<summary>
    Filters - array, optional
</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::timeSeries(filters: ['event:page==/blog**', 'visit:browser==Firefox'])
```
Your filters must be properly formed as per [plausible instructions](https://plausible.io/docs/stats-api#filtering). Filters defaults to `null`.
</details>

<details>
<summary>
    Interval - string, optional
</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::timeSeries(interval: 'month')
```
Interval can only be either `month` or `date`. When not provided, it defaults to date.
</details>

<details>
<summary>
    Date - string, optional
</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::timeSeries(period: 'custom', date: '2023-01-01,2023-01-31')
```
Date in `Y-m-d` format. Individual date e.g `2023-01-04` or a range  `2023-01-01,2023-01-31`. When not provided, date defaults to `current date`.

>**Info**
> You must include `period: 'custom'` when you provide a date range.
</details>

### 4. Getting Breakdowns

To get a breakdown of your stats by some property, run a request as follows.

```php
use \NjoguAmos\Plausible\Facades\Plausible;

// Simple with defaults
$visitors = Plausible::breakdown();

// With optional parameters
$aggregates = Plausible::breakdown(
        property: 'event:page',
        period: '12mo',
        metrics: ['visitors', 'visits', 'pageviews'],
        filters: 'event:page==/blog**',
        limit: 500
    );
```
The response in a single digit number
```json
[
    {
        "bounce_rate": 71,
        "page": "/",
        "pageviews": 146,
        "visit_duration": 126,
        "visitors": 87,
        "visits": 77
    },
    {
        "bounce_rate": 54,
        "page": "/articles",
        "pageviews": 179,
        "visit_duration": 206,
        "visitors": 71,
        "visits": 50
    },
    {
        "bounce_rate": 81,
        "page": "/blog/about-laravel-plausible",
        "pageviews": 42,
        "visit_duration": 27,
        "visitors": 35,
        "visits": 37
    },
    {
        "bounce_rate": 52,
        "page": "/pricing",
        "pageviews": 72,
        "visit_duration": 147,
        "visitors": 31,
        "visits": 27
    },
    {
        "bounce_rate": 76,
        "page": "/aquatadas",
        "pageviews": 22,
        "visit_duration": 82,
        "visitors": 21,
        "visits": 21
    }
]
```

#### Breakdown parameters explained `expand to view more details`.

<details>
<summary>Property - string, optional</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::breakdown(property: '6mo')
```
The `property` MUST be either of the allowed ones i.e. `visitors`, `visits`, `pageviews`, `bounce_rate`, or `visit_duration`. If not provided, period will default to all allowed;
</details>

<details>
<summary>Period - string, optional</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::breakdown(period: '6mo')
```
The `period` MUST be either of the allowed ones i.e `12mo`,`6mo`,`month`,`0d`,`7d`,`day`, or `custom`. If not provided, period will default to `30d`;
</details>


<details>
<summary>
    Date - string, optional
</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::breakdown(date: '2023-01-01')
```
Date in `Y-m-d` format.
>**Info**
> `period: 'custom'` is not supported. `date: '2023-01-01,2023-02-02' is not supported.
</details>

<details>
<summary>
    Metrics - array, optional
</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::breakdown(metrics: ['visits', 'pageviews', 'views_per_visit'])
```
The `metrics` must contain either of the allowed ones i.e `visitors`,`visits`,`pageviews`,`views_per_visit`,`bounce_rate`,`visit_duration`, or `events`. If not provided, all metrics will be included.
</details>

<details>
<summary>
    Limit - int, optional
</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;;

$aggregates = Plausible::breakdown(limit: 200)
```
The results limit. It must be between `1` and `1000`. When not provided, limit defaults to `100`.
</details>

<details>
<summary>
    Page - int, optional
</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;;

$aggregates = Plausible::breakdown(page: 2)
```
Page for the results. When not provided, page defaults to `1`.
</details>

<details>
<summary>
    Filters - string, optional
</summary>

```php
use NjoguAmos\Plausible\Facades\Plausible;

$aggregates = Plausible::breakdown(filters: 'event:page==/blog**')
```
Your filters must be properly formed as per [plausible instructions](https://plausible.io/docs/stats-api#filtering). Filters defaults to `null`.

>**Info**
> Multiple filters are not supported.

</details>


### 5. Caching Response

To increased performance of your application and reduce reliance to plausible api, all requests are cached for 3 minutes. You can specify cache duration (in seconds) and driver using the following env variables.

```dotenv
PLAUSIBLE_CACHE_DURATION=300
PLAUSIBLE_CACHE_DRIVER=redis
```

If for some reason you don't want to cache response, you can turn off caching entirely by adding the following env variable.

```dotenv
PLAUSIBLE_CACHE=false
```


## Testing
>**Info**
> To test this package, run the following command.

```bash
composer test
```

## Changelog

Please see [releases](https://github.com/njoguamos/laravel-plausible/releases) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Njogu Amos](https://github.com/njoguamos)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
