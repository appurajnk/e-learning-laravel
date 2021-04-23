<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'view backend',
                'guard_name' => 'web',
                'created_at' => '2019-09-26 21:36:33',
                'updated_at' => '2019-09-26 21:36:33',
            ),
        ));
        

        \DB::table('role_has_permissions')->delete();
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 1
            ),
        ));
        
    }
}