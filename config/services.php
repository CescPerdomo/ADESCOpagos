<?php

return [
    "mailgun" => [
        "domain" => env("MAILGUN_DOMAIN"),
        "secret" => env("MAILGUN_SECRET"),
        "endpoint" => env("MAILGUN_ENDPOINT", "api.mailgun.net"),
        "scheme" => "https",
    ],

    "postmark" => [
        "token" => env("POSTMARK_TOKEN"),
    ],

    "ses" => [
        "key" => env("AWS_ACCESS_KEY_ID"),
        "secret" => env("AWS_SECRET_ACCESS_KEY"),
        "region" => env("AWS_DEFAULT_REGION", "us-east-1"),
    ],

    "paypal" => [
        "client_id" => env("PAYPAL_CLIENT_ID", "AZU65mUaDihHkkAH_57epB1l3HXwds7YRFc8Fmy3hgTe4ahGIK-Cbi6RejmvuDRNwTBu6RS58qL1GNzh"),
        "secret" => env("PAYPAL_SECRET", "EMGCETnlccZxIy8tt9tq0r8iy1zFOql19dFiq5x04ChRKEB0zZoeyPgJE6PFY26r7TohO_nBQDR2BRI6"),
        "mode" => env("PAYPAL_MODE", "sandbox"),
        "currency" => env("PAYPAL_CURRENCY", "USD"),
    ],
];
