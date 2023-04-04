<?php

return [
    /*
      |--------------------------------------------------------------------------
      | API Key
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

    'metrics' => [
        'default'   => 'visitors,visits,pageviews,views_per_visit,bounce_rate,visit_duration',
        'breakdown' => 'visitors,visits,pageviews,bounce_rate,visit_duration',
    ],
];
