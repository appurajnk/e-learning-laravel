<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'carbon_code' => 'ar',
                'php_code' => 'ar_AR',
                'name' => 'Arabic',
                'is_rtl' => 1,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-13 13:36:31',
            ),
            1 => 
            array (
                'id' => 2,
                'carbon_code' => 'az',
                'php_code' => 'az_AZ',
                'name' => 'Azerbaijan',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-13 12:05:30',
            ),
            2 => 
            array (
                'id' => 3,
                'carbon_code' => 'da',
                'php_code' => 'da_DK',
                'name' => 'Danish',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            3 => 
            array (
                'id' => 4,
                'carbon_code' => 'de',
                'php_code' => 'de_DE',
                'name' => 'German',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            4 => 
            array (
                'id' => 5,
                'carbon_code' => 'el',
                'php_code' => 'el_GR',
                'name' => 'Greek',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            5 => 
            array (
                'id' => 6,
                'carbon_code' => 'en',
                'php_code' => 'en_US',
                'name' => 'English',
                'is_rtl' => 0,
                'is_default' => 1,
                'is_active' => 1,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-13 12:05:25',
            ),
            6 => 
            array (
                'id' => 7,
                'carbon_code' => 'es',
                'php_code' => 'es_ES',
                'name' => 'Spanish',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            7 => 
            array (
                'id' => 8,
                'carbon_code' => 'fa',
                'php_code' => 'fa_IR',
                'name' => 'Persian',
                'is_rtl' => 1,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            8 => 
            array (
                'id' => 9,
                'carbon_code' => 'fr',
                'php_code' => 'fr_FR',
                'name' => 'French',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 1,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-13 12:33:06',
            ),
            9 => 
            array (
                'id' => 10,
                'carbon_code' => 'he',
                'php_code' => 'he_IL',
                'name' => 'Hebrew',
                'is_rtl' => 1,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            10 => 
            array (
                'id' => 11,
                'carbon_code' => 'id',
                'php_code' => 'id_ID',
                'name' => 'Indonesian',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            11 => 
            array (
                'id' => 12,
                'carbon_code' => 'it',
                'php_code' => 'it_IT',
                'name' => 'Italian',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            12 => 
            array (
                'id' => 13,
                'carbon_code' => 'ja',
                'php_code' => 'ja-JP',
                'name' => 'Japanese',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            13 => 
            array (
                'id' => 14,
                'carbon_code' => 'nl',
                'php_code' => 'nl_NL',
                'name' => 'Dutch',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            14 => 
            array (
                'id' => 15,
                'carbon_code' => 'no',
                'php_code' => 'no_NO',
                'name' => 'Norwegian',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            15 => 
            array (
                'id' => 16,
                'carbon_code' => 'pt_BR',
                'php_code' => 'pt_BR',
                'name' => 'Brazilian Portuguese',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-13 12:05:32',
            ),
            16 => 
            array (
                'id' => 17,
                'carbon_code' => 'ru',
                'php_code' => 'ru-RU',
                'name' => 'Russian',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            17 => 
            array (
                'id' => 18,
                'carbon_code' => 'sv',
                'php_code' => 'sv_SE',
                'name' => 'Swedish',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            18 => 
            array (
                'id' => 19,
                'carbon_code' => 'th',
                'php_code' => 'th_TH',
                'name' => 'Thai',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            19 => 
            array (
                'id' => 20,
                'carbon_code' => 'tr',
                'php_code' => 'tr_TR',
                'name' => 'Turkish',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            20 => 
            array (
                'id' => 21,
                'carbon_code' => 'uk',
                'php_code' => 'uk-UA',
                'name' => 'Ukrainian',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
            21 => 
            array (
                'id' => 22,
                'carbon_code' => 'zh',
                'php_code' => 'zh-CN',
                'name' => 'Chinese',
                'is_rtl' => 0,
                'is_default' => 0,
                'is_active' => 0,
                'created_at' => '2019-10-12 12:58:20',
                'updated_at' => '2019-10-12 12:58:20',
            ),
        ));
        
        
    }
}