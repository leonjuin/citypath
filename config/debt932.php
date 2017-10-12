<?php

return [

    /*
      |--------------------------------------------------------------------------
      | Analytics
      |
      | Local, development and staging environments should use a test GA profile
      | Production environment should use the main GA profile
      |--------------------------------------------------------------------------
     */
    'google_analytics_id' => env('GOOGLE_ANALYTICS_ID', false),
    /*
      |--------------------------------------------------------------------------
      | Social media
      |--------------------------------------------------------------------------
     */
    'sm_facebook' => 'https://www.facebook.com/xxx',
    'sm_twitter' => 'https://twitter.com/xxx',
    'sm_twitter_username' => 'xxx',
    'sm_youtube' => 'https://www.youtube.com/channel/xxx',
    'sm_pinterest' => 'https://www.pinterest.com/xxx/',
    'sm_blog' => '',
    /*
      |--------------------------------------------------------------------------
      | Email addresses
      |--------------------------------------------------------------------------
     */
    'support_email' => 'hello@xxx.com',
    /*
      |--------------------------------------------------------------------------
      | Typekit
      |--------------------------------------------------------------------------
     */
    'typekit_code' => '',
    /*
      |--------------------------------------------------------------------------
      | CDN urls
      |--------------------------------------------------------------------------
     */
    'cdn' => [
        'static' => '', //https://s3-ap-southeast-1.amazonaws.com/which-tokyo
        'build' => env('CDN_BUILD', ''),
    ],
    /*
      |--------------------------------------------------------------------------
      | Default SEO
      |--------------------------------------------------------------------------
     */
    'default_page_description' => "",
    /*
      |--------------------------------------------------------------------------
      | Google Server Key
      |--------------------------------------------------------------------------
     */
    'google_server_key' => env('GOOGLE_SERVER_KEY', false),
];
