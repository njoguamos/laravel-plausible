![Cover image](/cover.png)
# Plausible Analytics for Laravel 10+

[![Latest Version on Packagist](https://img.shields.io/packagist/v/njoguamos/laravel-plausible.svg?style=flat-square)](https://packagist.org/packages/njoguamos/laravel-plausible)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/njoguamos/laravel-plausible/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/njoguamos/laravel-plausible/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/njoguamos/laravel-plausible/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/njoguamos/laravel-plausible/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/njoguamos/laravel-plausible.svg?style=flat-square)](https://packagist.org/packages/njoguamos/laravel-plausible)

[Plausible](https://plausible.io/) Plausible is intuitive, lightweight and open source web analytics. Plausible has no cookies and fully compliant with GDPR, CCPA and PECR.

>**Info**
> This package focuses on server side validation. 

## Installation

You can install the package via composer:

```bash
composer require njoguamos/laravel-plausible
```

You can initialise the package with:

```bash
php artisan plausible:install
```

The install command will publish the [config file](/config/plausible.php).

Ensure that you have update your application `.env` with credentials from [cloudflare](https://developers.cloudflare.com/plausible/get-started/) i.e.

```dotenv
#.env file

PLAUSIBLE_SITE_ID=
PLAUSIBLE_API_KEY=
```

## Usage
There are three way to use this package.

### 1. Getting Realtime Visitors

To get the current visitors on your default site, run a request as follows.

```php
use \NjoguAmos\Plausible\Plausible;

$visitors = (new Plausible())->realtime();
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

### 1. Getting Aggregates

To get the aggregates, run a request as follows.

```php
use \NjoguAmos\Plausible\Plausible;

// Simple with default
$aggregates = (new Plausible())->aggregates();

// Or with optional custom parameters
$aggregates = (new Plausible())
    ->aggregates(
        period: 'custom',
        metrics: ['visitors', 'visits', 'pageviews'],
        filters: ['event:page==/blog**', 'visit:country==KE'],
        date: '2023-01-01,2023-01-31'
    );
```
The response a json
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

<details open>
<summary>Period - string, optional</summary>

```php
use \NjoguAmos\Plausible\Plausible;

$aggregates = (new Plausible(period: '7d'))->aggregates()
```
The `period` MUST be either of the allowed ones i.e `12mo`,`6mo`,`month`,`0d`,`7d`,`day`, or `custom`. If not provided, period will default to `30d`;
</details>

<details>
<summary> 
    Metrics - array, optional
</summary>

```php
use \NjoguAmos\Plausible\Plausible;

$aggregates = (new Plausible())->aggregates(metrics: ['visitors', 'visits'])
```
The `metrics` must contain either of the the allowed ones i.e `visitors`,`visits`,`pageviews`,`views_per_visit`,`bounce_rate`,`visit_duration`, or `events`. If not provided, all metrics will be included.
</details>

<details>
<summary> 
    Compare - boolean, optional
</summary>

```php
use \NjoguAmos\Plausible\Plausible;

$aggregates = (new Plausible())->aggregates(compare: false )
```
`compare` defaults to `true`, meaning that the percent difference with the previous period for each metric will be calculated.
</details>


<details>
<summary> 
    Filters - array, optional
</summary>

```php
use \NjoguAmos\Plausible\Plausible;

$aggregates = (new Plausible())->aggregates(filters: ['event:page==/blog**', 'visit:country==KE|DE'])
```
Your filters must be properly formed as per [plausible instructions](https://plausible.io/docs/stats-api#filtering). Filters defaults to `null`.
</details>

<details>
<summary> 
    Date - string, optional
</summary>

```php
use \NjoguAmos\Plausible\Plausible;

$aggregates = (new Plausible())->aggregates(period: 'custom', date: '2023-01-01,2023-01-31')
```
Date in `Y-m-d` format. Individual date e.g `2023-01-04` or a range  `2023-01-01,2023-01-31`. When not provided, date defaults to `current date`.

>**Info**
> You must include `period: 'custom'` when you provide a date range.
</details>

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
