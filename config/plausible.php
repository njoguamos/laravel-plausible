<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Site ID (Domain)
      |--------------------------------------------------------------------------
      |
      | Each request requires a site_id parameter which is the domain of your
      | site as configured in Plausible. If you're unsure, navigate to your
      | site settings in Plausible and grab the value of the domain field.
      |
      |
      */
    'site_id' => env(key: 'PLAUSIBLE_SITE_ID'),

    /*
      |--------------------------------------------------------------------------
      | API Key
      |--------------------------------------------------------------------------
      |
      | Each request must be authenticated with an API key using the Bearer Token
      | method. You can obtain an API key for your account by going to your user
      | settings page plausible.io/settings.
      |
      |
      */
    'api_key' => env(key: 'PLAUSIBLE_API_KEY'),

    /*
      |--------------------------------------------------------------------------
      | Metrics
      |--------------------------------------------------------------------------
      |
      | Metrics are a variety of measurements made on your plausible website
      | in order to better track its performance and statistics.
      |
      | @see https://plausible.io/docs/metrics-definitions
      |
      */
    'metrics' => [
        'default'   => env(key: 'PLAUSIBLE_METRICS_DEFAULT', default: 'visitors,visits,pageviews,views_per_visit,bounce_rate,visit_duration'),
        'breakdown' => env(key: 'PLAUSIBLE_METRICS_BREAKDOWN', default: 'visitors,visits,pageviews,bounce_rate,visit_duration'),
    ],
];
