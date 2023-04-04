![Cover image](/cover.png)
# Plausible Analytics for Laravel 8+

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

```text
@TODO: Working on it
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
