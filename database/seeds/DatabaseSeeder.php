<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;

class DatabaseSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        //Model::unguard();
        //$file = new Filesystem;
        //$file->cleanDirectory(public_path('uploads/images/course/thumbnails'));

        $this->disableForeignKeys();
        $this->truncateMultiple([
            'cache',
            'jobs',
            'sessions',
            'countries',
            'languages',
            'categories',
            'periods',
            'currencies',
            config('permission.table_names.model_has_permissions'),
            config('permission.table_names.model_has_roles'),
            config('permission.table_names.role_has_permissions'),
            config('permission.table_names.permissions'),
            config('permission.table_names.roles'),
            'users',
            'password_histories',
            'password_resets',
            'social_accounts',
            'course_targets',
            'videos',
            'lessons',
            'sections',
            'courses'
        ]);

        // $this->call(CategoriesTableSeeder::class);
        // $this->call(CountrySeeder::class);
        // $this->call(PeriodsTableSeeder::class);
        // $this->call(CurrenciesTableSeeder::class);
        // $this->call(SettingsTableSeeder::class);
        // $this->call(LanguageSeeder::class);
        // $this->call(PagesTableSeeder::class);
        
        //$this->call(AuthTableSeeder::class);
        
        // $this->call(AdminUserTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        // $this->call(RolesTableSeeder::class);
        // $this->call(PermissionsTableSeeder::class);
        // $this->call(ModelHasRolesTableSeeder::class);
        // $this->call(CoursesTableSeeder::class);
        // $this->call(CourseTargetsTableSeeder::class);
        // $this->call(SectionsTableSeeder::class);
        // $this->call(LessonsTableSeeder::class);
        // $this->call(VideosTableSeeder::class);
        // $this->call(CouponsTableSeeder::class);
        // $this->call(CouponsTableSeeder::class);
        
        $this->enableForeignKeys();
        
        
        $this->call(LanguagesTableSeeder::class);
    }
}
