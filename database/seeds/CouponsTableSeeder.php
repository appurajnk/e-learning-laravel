<?php

use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('coupons')->delete();
        
        \DB::table('coupons')->insert(array (
            0 => 
            array (
                'id' => 3,
                'uuid' => '549b65d7-56b9-427e-9d3f-c50f8f213676',
                'course_id' => NULL,
                'code' => 'GLOBAL-DISCOUNT-80',
                'percent' => 80,
                'quantity' => 1000,
                'expires' => '2019-11-29',
                'active' => 1,
                'sitewide' => 1,
                'created_at' => '2019-09-28 17:14:01',
                'updated_at' => '2019-09-28 17:14:01',
            ),
        ));
        
        
    }
}