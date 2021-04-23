<?php

use Illuminate\Database\Seeder;

class AdminUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        \DB::table('model_has_roles')->delete();

        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => 'e0fd7870-c538-466a-8610-a427d8f72dbe',
                'first_name' => 'Admin',
                'last_name' => 'Istrator',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'avatar_type' => 'gravatar',
                'avatar_location' => NULL,
                'password' => '$2y$10$DnggYXvrKfsjwgNapsB2SOwFqwF1d3MN/LHxcePX3yAfTXTQ1FK9q',
                'password_changed_at' => NULL,
                'active' => 1,
                'confirmation_code' => '76f09724471f6851cbd93743e050ab18',
                'confirmed' => 1,
                'timezone' => 'America/New_York',
                'last_login_at' => '2019-09-26 22:02:34',
                'last_login_ip' => '127.0.0.1',
                'to_be_logged_out' => 0,
                'tagline' => 'Administrator',
                'bio' => '<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.
</p><p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.
</p>',
                'website' => '#',
                'linkedin' => '#',
                'facebook' => '#',
                'twitter' => '#',
                'youtube' => NULL,
                'github' => NULL,
                'remember_token' => NULL,
                'created_at' => '2019-09-26 21:36:33',
                'updated_at' => '2019-09-26 22:02:34',
                'deleted_at' => NULL,
                'settings' => NULL,
            )
        ));


        \DB::table('model_has_roles')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1,
            )
        ));   
        
        
    }
}