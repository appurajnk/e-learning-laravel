<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'administrator',
                'guard_name' => 'web',
                'created_at' => '2019-09-26 21:36:33',
                'updated_at' => '2019-09-26 21:36:33',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'user',
                'guard_name' => 'web',
                'created_at' => '2019-09-26 21:36:33',
                'updated_at' => '2019-09-26 21:36:33',
            ),
        ));
        
        
    }
}