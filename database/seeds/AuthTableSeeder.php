<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

/**
 * Class AuthTableSeeder.
 */
class AuthTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        resolve(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->call(UserTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);

        // factory(App\Models\User::class, 4)
        //     ->create()
        //     ->each(function($user) {
        //         $user->assignRole(config('access.users.default_role'));
        //         $user->authored_courses()->saveMany(factory(App\Models\Course::class, rand(4,10))->make())
        //             ->each(function($course){
        //                 // generate What To Learn
        //                 $course->requirements()->saveMany(factory(App\Models\CourseTarget::class, rand(3,4))->make(['type' => 'requirement']));
        //                 $course->target_students()->saveMany(factory(App\Models\CourseTarget::class, rand(3,4))->make(['type' => 'target_student']));
        //                 $course->what_to_learn()->saveMany(factory(App\Models\CourseTarget::class, rand(3,4))->make(['type' => 'what_to_learn']));

        //                 // create sections and lessons for each course
        //                 foreach(range(2,3) as $index){
        //                     $section = $course->sections()->save(factory(App\Models\Section::class)->make(['sortOrder' => $index]));
        //                     foreach(range(1, rand(2,4)) as $idx){
        //                         $lesson = $section->lessons()->save(factory(App\Models\Lesson::class)->make(['course_id' => $course->id, 'sortOrder' => $idx]) );
        //                         if($lesson->content_type == 'youtube' || $lesson->content_type == 'video'){
        //                             $is_encoded = $lesson->content_type == 'video' ? 1 : 0;
        //                             $lesson->video()->save(factory(App\Models\Video::class)->make(['encoded' => $is_encoded]));
        //                         }
        //                     }
        //                 }
        //             });
        //     });

        
        // foreach(\App\Models\Course::all() as $course){
        //     event(new \App\Events\UpdateCourseStats($course, 'course_content_stats'));
        // }
    }
}
