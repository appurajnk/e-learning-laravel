<?php

use Illuminate\Database\Seeder;

class InitialSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'payments.enable_paypal',
                'value' => '1',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'payments.enable_credit_card',
                'value' => '1',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'payments.credit_card_processor',
                'value' => 'stripe',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'payments.paypal_mode',
                'value' => 'sandbox',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'payments.stripe_mode',
                'value' => 'sandbox',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'payments.razorpay_mode',
                'value' => 'sandbox',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'payments.stripe_sandbox_public_key',
                'value' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'payments.stripe_sandbox_secret_key',
                'value' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'payments.stripe_live_public_key',
                'value' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'payments.stripe_live_secret_key',
                'value' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'payments.razorpay_sandbox_public_key',
                'value' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'payments.razorpay_sandbox_secret_key',
                'value' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'payments.razorpay_live_public_key',
                'value' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'payments.razorpay_live_secret_key',
                'value' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'payments.paypal_sandbox_client_id',
                'value' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'payments.paypal_sandbox_secret',
                'value' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'payments.paypal_live_client_id',
                'value' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'payments.paypal_live_secret',
                'value' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'site.site_description',
                'value' => 'Your online learning platform',
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'site.site_keywords',
                'value' => 'Online course, Udemy alternative',
            ), 
            20 =>
            array (
                'id' => 21,
                'key' => 'site.video_upload_location',
                'value' => 'local',
            ),
            21 => 
            array (
                'id' => 22,
                'key' => 'site.video_max_size_mb',
                'value' => '20',
            ),
            22 => 
            array (
                'id' => 23,
                'key' => 'site.video_providers',
                'value' => 'both',
            ),
            23 => 
            array (
                'id' => 24,
                'key' => 'site.site_address',
                'value' => '1',
            ),
            24 => 
            array (
                'id' => 25,
                'key' => 'site.earning_organic_sales_percentage',
                'value' => '40',
            ),
            25 => 
            array (
                'id' => 26,
                'key' => 'site.earning_promo_sales_percentage',
                'value' => '75',
            ),
            26 => 
            array (
                'id' => 27,
                'key' => 'site.site_google_analytics',
                'value' => 'UA-XXXXXX-XX',
            ),
            27 => 
            array (
                'id' => 28,
                'key' => 'site.logo',
                'value' => '/images/logo.png',
            ),
            28 => 
            array (
                'id' => 29,
                'key' => 'site.favicon',
                'value' => '/images/favicon.png',
            ),
            29 => 
            array (
                'id' => 30,
                'key' => 'site.homepage_image',
                'value' => '/images/homepage_image.png',
            ),
            30 => 
            array (
                'id' => 31,
                'key' => 'site.encode_videos',
                'value' => '0',
            ),
            31 => 
            array (
                'id' => 32,
                'key' => 'site.enable_demo_mode',
                'value' => '0',
            ),
            32 => 
            array (
                'id' => 33,
                'key' => 'site.redirect_https',
                'value' => '0',
            ),
            33 => 
            array (
                'id' => 34,
                'key' => 'site.site_currency',
                'value' => 'USD',
            ),
            34 => 
            array (
                'id' => 35,
                'key' => 'site.video_hd_dimension',
                'value' => '1280, 720',
            ),
            35 => 
            array (
                'id' => 36,
                'key' => 'site.video_sd_dimension',
                'value' => '640, 360',
            ),
            36 => 
            array (
                'id' => 37,
                'key' => 'site.s3_access_id',
                'value' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'key' => 'site.s3_secret_access_key',
                'value' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'key' => 'site.s3_default_region',
                'value' => 'us-east-1',
            ),
            39 => 
            array (
                'id' => 40,
                'key' => 'site.s3_bucket',
                'value' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'key' => 'site.s3_url',
                'value' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'key' => 'site.queue_connection',
                'value' => 'sync',
            ),
            42 => 
            array (
                'id' => 43,
                'key' => 'mail.mailing_address',
                'value' => '1 Some Street<br />
Cambridge ON<br />
J9A4SW Canada',
            ),
            43 => 
            array (
                'id' => 44,
                'key' => 'site.site_language',
                'value' => 'en',
            ),
        ));
    }
}
