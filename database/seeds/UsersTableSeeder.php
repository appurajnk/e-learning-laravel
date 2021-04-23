<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        //\DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 2,
                'uuid' => '1a509abd-635b-4a2c-8938-3a38b73e78f7',
                'first_name' => 'Russ',
                'last_name' => 'Ankunding',
                'username' => 'mohr.okey',
                'email' => 'lmosciski@example.net',
                'avatar_type' => 'gravatar',
                'avatar_location' => NULL,
                'password' => '$2y$10$VQdNjKz2Ap9S149nA4rytOfmFmka9warDV0n1RJfoQ6c6a0Kq4AH6',
                'password_changed_at' => NULL,
                'active' => 1,
                'confirmation_code' => 'faaa77795b6f4fe6a395945cc04c6dea',
                'confirmed' => 1,
                'timezone' => NULL,
                'last_login_at' => NULL,
                'last_login_ip' => NULL,
                'to_be_logged_out' => 0,
                'tagline' => 'Web Developer',
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
                'github' => '#',
                'remember_token' => 'LYrEOa1Co2',
                'created_at' => '2019-09-26 21:36:34',
                'updated_at' => '2019-09-26 21:36:34',
                'deleted_at' => NULL,
                'settings' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'uuid' => 'bfd1e567-c40a-4f1e-9999-7ec723bc589b',
                'first_name' => 'Madge',
                'last_name' => 'Schmitt',
                'username' => 'virgil34',
                'email' => 'pwalker@example.net',
                'avatar_type' => 'gravatar',
                'avatar_location' => NULL,
                'password' => '$2y$10$oaggfS2tKBQLtkLqESQ/Qu50GSaqkan/5Xr09h7Baw9xZ.hkgNING',
                'password_changed_at' => NULL,
                'active' => 1,
                'confirmation_code' => '133d6e41d4354d0ea0ca0a380c64283e',
                'confirmed' => 1,
                'timezone' => NULL,
                'last_login_at' => NULL,
                'last_login_ip' => NULL,
                'to_be_logged_out' => 0,
                'tagline' => 'Senior Accountant',
                'bio' => '<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.
</p><p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.
</p>',
                'website' => '#',
                'linkedin' => '#',
                'facebook' => '#',
                'twitter' => NULL,
                'youtube' => NULL,
                'github' => NULL,
                'remember_token' => 'vWsbYc2ESH',
                'created_at' => '2019-09-26 21:36:34',
                'updated_at' => '2019-09-26 21:36:34',
                'deleted_at' => NULL,
                'settings' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'uuid' => 'ee62c2dc-9c43-47f3-8038-ced22d059835',
                'first_name' => 'Major',
                'last_name' => 'Kutch',
                'username' => 'gwendolyn54',
                'email' => 'graham.nora@example.org',
                'avatar_type' => 'gravatar',
                'avatar_location' => NULL,
                'password' => '$2y$10$QJ6VXzj.ECS/Imchkav5Y.7PnDS4iojpEFDz9gehexJWhAQgM6.rG',
                'password_changed_at' => NULL,
                'active' => 1,
                'confirmation_code' => '51428eb3dff444134c2c90c22cd99663',
                'confirmed' => 1,
                'timezone' => NULL,
                'last_login_at' => NULL,
                'last_login_ip' => NULL,
                'to_be_logged_out' => 0,
                'tagline' => 'Fullstack Developer',
                'bio' => '<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.
</p><p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.
</p>',
                'website' => '#',
                'linkedin' => '#',
                'facebook' => '#',
                'twitter' => NULL,
                'youtube' => '#',
                'github' => '#',
                'remember_token' => 'IDQcFYvek6',
                'created_at' => '2019-09-26 21:36:34',
                'updated_at' => '2019-09-26 21:36:34',
                'deleted_at' => NULL,
                'settings' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'uuid' => 'a9ea1d3e-68b4-4af0-ade8-757e66adf0b9',
                'first_name' => 'Kathryne',
                'last_name' => 'Goldner',
                'username' => 'rreichert',
                'email' => 'damon47@example.org',
                'avatar_type' => 'gravatar',
                'avatar_location' => NULL,
                'password' => '$2y$10$H7gf.7/2jgERwCeUvH5W8uDwkY9zgDxVdS7YCuImCNRHBJBqvToU2',
                'password_changed_at' => NULL,
                'active' => 1,
                'confirmation_code' => 'de311e2cac35060f1ad0779111052db5',
                'confirmed' => 1,
                'timezone' => NULL,
                'last_login_at' => NULL,
                'last_login_ip' => NULL,
                'to_be_logged_out' => 0,
                'tagline' => 'Writer / Data Analyst',
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
                'remember_token' => '8t673BQeYA',
                'created_at' => '2019-09-26 21:36:34',
                'updated_at' => '2019-09-26 21:36:34',
                'deleted_at' => NULL,
                'settings' => NULL,
            ),
        ));
        
        
    }
}