<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enable / Disable auto save
    |--------------------------------------------------------------------------
    |
    | Auto-save every time the application shuts down
    |
    */
    'auto_save'         => false,

    /*
    |--------------------------------------------------------------------------
    | Setting driver
    |--------------------------------------------------------------------------
    |
    | Select where to store the settings.
    |
    | Supported: "database", "json"
    |
    */
    'driver'            => 'database',

    /*
    |--------------------------------------------------------------------------
    | Database driver
    |--------------------------------------------------------------------------
    |
    | Options for database driver. Enter which connection to use, null means
    | the default connection. Set the table and column names.
    |
    */
    'database' => [
        'connection'    => null,
        'table'         => 'settings',
        'key'           => 'key',
        'value'         => 'value',
    ],

    /*
    |--------------------------------------------------------------------------
    | JSON driver
    |--------------------------------------------------------------------------
    |
    | Options for json driver. Enter the full path to the .json file.
    |
    */
    'json' => [
        'path'          => storage_path() . '/settings.json',
    ],

    /*
    |--------------------------------------------------------------------------
    | Override application config values
    |--------------------------------------------------------------------------
    |
    | If defined, settings package will override these config values.
    |
    | Sample:
    |   "app.locale" => "settings.locale",
    |
    */
    'override' => [
        'app.name' => 'site.site_name',
        //'app.read_only' => 'site.enable_demo_mode',
        'app.locale' => 'site.site_language',
        'mail.driver' => 'mail.diver',
        'mail.host' => 'mail.smtp_host',
        'mail.port' => 'mail.smtp_port',
        'mail.username' => 'mail.smtp_username',
        'mail.password' => 'mail.smtp_password',
        'mail.from.address' => 'mail.from_address',
        'mail.from.name' => 'mail.from_name',
        'mail.sendmail' => 'mail.sendmail_path',
        'services.mailgun.domain' => 'mail.mailgun_domain',
        'services.mailgun.secret' => 'mail.mailgun_secret',
        'services.mailgun.endpoint' => 'mail.mailgun_endpoint',
        'services.postmark.token' => 'mail.postmark_token',
        'services.ses.key' => 'mail.ses_key',
        'services.ses.secret' => 'mail.ses_secret',
        'services.ses.region' => 'mail.ses_region',
        'services.sparkpost.secret' => 'mail.sparkpost_secret',

        'analytics.google-analytics' => 'site.site_google_analytics',

        'filesystems.disks.s3.key' => 'site.s3_access_id',
        'filesystems.disks.s3.secret' => 'site.s3_secret_access_key',
        'filesystems.disks.s3.region' => 'site.s3_default_region',
        'filesystems.disks.s3.bucket' => 'site.s3_bucket',
        'filesystems.disks.s3.url' => 'site.s3_url',

        'queue.default' => 'site.queue_connection',

        'paypal.settings.mode' => 'payments.paypal_mode'


    ],

    /*
    |--------------------------------------------------------------------------
    | Required Extra Columns
    |--------------------------------------------------------------------------
    |
    | The list of columns required to be set up
    |
    | Sample:
    |   "user_id",
    |   "tenant_id",
    |
    */
    'required_extra_columns' => [

    ],
];
