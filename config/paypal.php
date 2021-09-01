<?php

return [

    'mode' => env('PAYPAL_MODE', 'sandbox'),

    'sandbox' => [

        'username' => env('PAYPAL_SANDBOX_API_USERNAME', "site_setting('paypal_username')"),

        'password' => env('PAYPAL_SANDBOX_API_PASSWORD', "site_setting('paypal_password')"),

        'secret' => env('PAYPAL_SANDBOX_API_SECRET', "site_setting('paypal_secret')"),

        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),

        'app_id' => 'APP-80W284485P519543T',

    ],

    'live' => [

        'username' => env('PAYPAL_LIVE_API_USERNAME', ''),

        'password' => env('PAYPAL_LIVE_API_PASSWORD', ''),

        'secret' => env('PAYPAL_LIVE_API_SECRET', ''),

        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),

        'app_id' => '',

    ],

    'payment_action' => 'Sale',

    'currency' => env('PAYPAL_CURRENCY', 'USD'),

    'billing_type' => 'MerchantInitiatedBilling',

    'notify_url' => '',

    'locale' => '',

    'validate_ssl' => false,

];
