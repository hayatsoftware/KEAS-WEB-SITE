<?php

return [

    'app_env' => env('APP_ENV', 'production'),
    'app_url' => env('APP_URL'),

    'support_webp' => env("MEDIAPRESS_SUPPORT_WEBP"),
    'image_quality' => env('MP_QUALITY', 90),
    'elasticsearch_host' => env('ELASTICSEARCH_HOST'),

    'log' => [
        'enable' => env('MEDIAPRESS_LOG', true),
        'url' => env('MEDIAPRESS_LOG_URL', 'https://log.mediaclickhost.com/'),
        'customer' => env("MEDIAPRESS_LOG_CUSTOMER", true),
    ],


    'categories' => env('MEDIAPRESS_CATEGORIES', true),
    'pages' => env('MEDIAPRESS_PAGES', false),


    'cdn' => env('MEDIAPRESS_CDN', false),

    'recaptcha' => [
        'secret_key' => env('RECAPTCHA_SECRET_KEY'),
        'site_key' => env('RECAPTCHA_SITE_KEY'),
    ],

    'vue_url' => env("VUE_URL", null),
    'mail' => [
        'sender_function' => env('MAIL_SENDER_FUNCTION'),
    ],


    'view_cache' => env('MEDIAPRESS_VIEW_CACHE', false),
    'minify' => env('MEDIAPRESS_MINIFY', false),
    'unit_test' => env('UNIT_TEST'),

    'allow_postdate_content' => env("ALLOW_POSTDATE_CONTENT", true),

    'filesystem' => [
        'public_uploads_default' => env("FILESYSTEM_PUBLIC_UPLOADS_DEFAULT", 'uploads'),
        'secure_uploads_default' => env("FILESYSTEM_SECURE_UPLOADS_DEFAULT", 'public'),
    ],

    'searchrpp' => env('MEDIAPRESS_SEARCHRPP', 10),
    'renderkeywords' => env('MEDIAPRESS_RENDERKEYWORDS', true),

    'default_email_address' => env("DEFAULT_EMAIL_ADDRESS", "test@test.com"),

    'ebulletin' => [
        'mail_subject' => env('EBULLETIN_MAIL_SUBJECT', 'E-Bülten Kaydı'),
        'sender_email' => env('EBULLETIN_MAIL_SENDER_EMAIL', 'test@test.com'),
        'sender_name' => env('EBULLETIN_MAIL_SENDER_NAME', 'test'),
        'view_page' => env('EBULLETIN_MAIL_VIEW_PAGE', 'vendor.mail.ebulletin'),
        'mail_message' => env("EBULLETIN_MAIL_MESSAGE", "E-bülten kaydınız başarıyla oluşturuldu! Teşekkür ederiz."),
    ],

    'form_mail' => [
        'sender_email' => env('FORM_MAIL_SENDER_EMAIL', 'test@test.com'),
        'sender_name' => env('FORM_MAIL_SENDER_NAME', 'test'),
        'view_page' => env('FORM_MAIL_VIEW_PAGE', 'vendor.mail.form'),
    ],


    'heraldist' => [
        'mailchimp.apikey' => env('heraldist.mailchimp.apikey'),
        'mpmailler' => [
            'fromemailaddress' => env('heraldist.mailchimp.fromemailaddress'),
            'fromname' => env('heraldist.mailchimp.fromname')
        ],
    ],
    'mpcore.analytics' => [
        'bing' => [
            'apikey' => env('mpcore.analytics.bing.apikey'),
            'api_website_url' => env('mpcore.analytics.bing.api_website_url'),
        ],
        'yandex' => [
            'cache' => env('mpcore.analytics.yandex.cache'),
            'counter_id' => env('mpcore.analytics.bing.counter_id'),
            'token' => env('mpcore.analytics.bing.token'),
        ]
    ],

    'interaction' => [
        'driver' => env('INTERACTION_DRIVER', 'sqlite'),
        'database' => env('INTERACTION_DATABASE', storage_path('app/database/Interaction.sqlite')),
    ],

    'google2fa' => env("MEDIAPRESS_GOOGLE2FA", false),
    'google2fa_required' => env("MEDIAPRESS_GOOGLE2FA_REQUIRED", false),

    'asset_cache' => env("MEDIAPRESS_ASSET_CACHE", false),

    'redirect_browser_language' => env("MEDIAPRESS_REDIRECT_BROWSER_LANGUAGE", true),

    'force_redirect_to_zone' => env("MEDIAPRESS_REDIRECT_ZONE", false),

    'flow' => [
        'record' => env("MEDIAPRESS_RECORD_FLOW", true),
    ]
];
