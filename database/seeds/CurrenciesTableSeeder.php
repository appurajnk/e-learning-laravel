<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('currencies')->delete();
        \DB::table('currencies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'US Dollars',
                'code' => 'USD',
                'symbol' => '$',
                'symbol_position' => 'left',
                'conversion_rate' => 1.0,
                'is_primary' => 1,
                'enabled' => 1,
                'space_between' => 0,
                'created_at' => '2019-08-28 09:14:08',
                'updated_at' => '2019-08-28 09:15:08',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Swiss Francs',
                'code' => 'CHF',
                'symbol' => 'CHF',
                'symbol_position' => 'left',
                'conversion_rate' => 1.2,
                'is_primary' => 0,
                'enabled' => 1,
                'space_between' => 0,
                'created_at' => '2019-08-28 09:14:59',
                'updated_at' => '2019-08-28 09:17:52',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Euro',
                'code' => 'EUR',
                'symbol' => '€',
                'symbol_position' => 'left',
                'conversion_rate' => 1.1,
                'is_primary' => 0,
                'enabled' => 1,
                'space_between' => 0,
                'created_at' => '2019-08-28 09:16:31',
                'updated_at' => '2019-08-28 09:17:31',
            ),
        ));
        
        
    }
}