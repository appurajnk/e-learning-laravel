<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // $this->disableForeignKeys();
        // $this->truncateMultiple([
        //     'categories'
        // ]);

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => 'a7deabcd-1331-4d90-9a19-d0164b673fa2',
                'name' => 'Development',
                'slug' => 'development',
                'parent_id' => NULL,
                'image' => 'im im-icon-Code-Window',
                'live' => 1,
                'sortOrder' => 1,
                'created_at' => '2018-11-17 00:00:00',
                'updated_at' => '2019-07-10 11:23:55',
            ),
            1 => 
            array (
                'id' => 2,
                'uuid' => '18a0da19-d365-4c01-b0f5-8c22068ef99e',
                'name' => 'Web Development',
                'slug' => 'web-development',
                'parent_id' => 1,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 2,
                'created_at' => '2018-11-19 00:00:00',
                'updated_at' => '2019-07-10 11:23:55',
            ),
            2 => 
            array (
                'id' => 3,
                'uuid' => 'd162d970-a1be-463a-8a1c-fc5b39f35ab7',
                'name' => 'Mobile Apps',
                'slug' => 'mobile-apps',
                'parent_id' => 1,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 3,
                'created_at' => '2018-11-18 00:00:00',
                'updated_at' => '2018-11-18 00:00:00',
            ),
            3 => 
            array (
                'id' => 4,
                'uuid' => '5ff3f496-434d-48fe-9901-5fae87b3fc91',
                'name' => 'Programming Languages',
                'slug' => 'programming-languages',
                'parent_id' => 1,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 4,
                'created_at' => '2018-11-18 00:00:00',
                'updated_at' => '2018-11-18 00:00:00',
            ),
            4 => 
            array (
                'id' => 5,
                'uuid' => 'f70e6e5b-225a-4152-9234-f7e00946b81f',
                'name' => 'Business',
                'slug' => 'business',
                'parent_id' => NULL,
                'image' => 'im im-icon-Bar-Chart',
                'live' => 1,
                'sortOrder' => 5,
                'created_at' => '2018-11-17 00:00:00',
                'updated_at' => '2019-07-10 11:24:20',
            ),
            
            6 => 
            array (
                'id' => 7,
                'uuid' => '0d641b0d-a04f-4fb3-93d8-bc9961139e4b',
                'name' => 'Design',
                'slug' => 'design',
                'parent_id' => NULL,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 6,
                'created_at' => '2019-07-10 09:18:55',
                'updated_at' => '2019-07-10 11:27:14',
            ),
            7 => 
            array (
                'id' => 8,
                'uuid' => 'ace297d9-5abd-459f-b79b-955fc936cd43',
                'name' => 'Design Tools',
                'slug' => 'design-tools',
                'parent_id' => 7,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 7,
                'created_at' => '2019-07-10 09:19:15',
                'updated_at' => '2019-07-10 11:27:14',
            ),
            8 => 
            array (
                'id' => 9,
                'uuid' => '8ff1f4ba-1369-44e4-bb5c-470b6a14adfc',
                'name' => 'Graphic Design',
                'slug' => 'graphic-design',
                'parent_id' => 7,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 8,
                'created_at' => '2019-07-10 09:19:26',
                'updated_at' => '2019-07-10 11:31:02',
            ),
            9 => 
            array (
                'id' => 10,
                'uuid' => 'f58c23b0-e6e6-4b75-a04b-a8a1fbe842d1',
                'name' => 'Marketing',
                'slug' => 'marketing',
                'parent_id' => NULL,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 13,
                'created_at' => '2019-07-10 11:23:31',
                'updated_at' => '2019-07-10 11:27:09',
            ),
            10 => 
            array (
                'id' => 11,
                'uuid' => '5c119225-b8fd-4583-a0b6-582fdb83ba6e',
                'name' => 'IT and Software',
                'slug' => 'it-and-software',
                'parent_id' => NULL,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 11,
                'created_at' => '2019-07-10 11:24:52',
                'updated_at' => '2019-07-10 11:27:09',
            ),
            11 => 
            array (
                'id' => 12,
                'uuid' => '563b1a5f-9bd3-45b7-b6fb-194af5752fb7',
                'name' => 'Office Productivity',
                'slug' => 'office-productivity',
                'parent_id' => NULL,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 12,
                'created_at' => '2019-07-10 11:25:09',
                'updated_at' => '2019-07-10 11:27:09',
            ),
            12 => 
            array (
                'id' => 14,
                'uuid' => 'b086edfa-18b9-4c42-b640-a1ec63a87db6',
                'name' => 'Photography',
                'slug' => 'photography',
                'parent_id' => NULL,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 15,
                'created_at' => '2019-07-10 11:25:51',
                'updated_at' => '2019-07-10 11:27:09',
            ),
            13 => 
            array (
                'id' => 15,
                'uuid' => '919eecf9-5667-4607-a2c5-9a6e274e75a6',
                'name' => 'Health and Fitness',
                'slug' => 'health-and-fitness',
                'parent_id' => NULL,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 16,
                'created_at' => '2019-07-10 11:25:58',
                'updated_at' => '2019-07-10 11:27:09',
            ),
            14 => 
            array (
                'id' => 17,
                'uuid' => '056b123d-a389-466b-9fdf-252386aeae03',
                'name' => 'Finance and Accounting',
                'slug' => 'finance-and-accounting',
                'parent_id' => NULL,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 9,
                'created_at' => '2019-07-10 11:27:06',
                'updated_at' => '2019-07-10 11:27:14',
            ),
            5 => 
            array (
                'id' => 6,
                'uuid' => 'c2c0a7dd-cb65-47e7-9234-03e7e38df3fa',
                'name' => 'Accounting and Bookkeeping',
                'slug' => 'accounting-and-bookkeeping',
                'parent_id' => 17,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 10,
                'created_at' => '2018-11-18 00:00:00',
                'updated_at' => '2019-07-10 11:27:14',
            ),
            15 => 
            array (
                'id' => 18,
                'uuid' => 'e83bcdd9-80b2-4fb8-81de-d510e8e23f58',
                'name' => 'Game Development',
                'slug' => 'game-development',
                'parent_id' => 1,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 18,
                'created_at' => '2019-07-10 11:27:51',
                'updated_at' => '2019-07-10 11:27:51',
            ),
            16 => 
            array (
                'id' => 19,
                'uuid' => '13489877-ea24-4d79-ae6a-88c082fba0bc',
                'name' => 'Databases',
                'slug' => 'databases',
                'parent_id' => 1,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 19,
                'created_at' => '2019-07-10 11:27:58',
                'updated_at' => '2019-07-10 11:27:58',
            ),
            17 => 
            array (
                'id' => 20,
                'uuid' => '43aa9855-259a-4146-84ab-190209705721',
                'name' => 'Software Testing',
                'slug' => 'software-testing',
                'parent_id' => 1,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 20,
                'created_at' => '2019-07-10 11:28:18',
                'updated_at' => '2019-07-10 11:28:18',
            ),

            18 => 
            array (
                'id' => 21,
                'uuid' => 'fecfe06c-da3c-4180-89cb-7b11edae6687',
                'name' => 'Software Engineering',
                'slug' => 'software-engineering',
                'parent_id' => 1,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 21,
                'created_at' => '2019-07-10 11:28:29',
                'updated_at' => '2019-07-10 11:28:29',
            ),
            19 => 
            array (
                'id' => 22,
                'uuid' => '89380873-e74b-421e-b0be-8a2bc99a95e8',
                'name' => 'Development Tools',
                'slug' => 'development-tools',
                'parent_id' => 1,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 22,
                'created_at' => '2019-07-10 11:28:43',
                'updated_at' => '2019-07-10 11:28:43',
            ),
            20 => 
            array (
                'id' => 23,
                'uuid' => '9cfca9f5-49c4-4536-bf6b-6dbd09fe70c4',
                'name' => 'Entrepreneurship',
                'slug' => 'entrepreneurship',
                'parent_id' => 5,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 23,
                'created_at' => '2019-07-10 11:29:11',
                'updated_at' => '2019-07-10 11:29:11',
            ),
            21 => 
            array (
                'id' => 24,
                'uuid' => 'ff817036-0f4e-41a8-a7d4-383a1fc9e29b',
                'name' => 'Communication',
                'slug' => 'communication',
                'parent_id' => 5,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 24,
                'created_at' => '2019-07-10 11:29:29',
                'updated_at' => '2019-07-10 11:29:29',
            ),
            22 => 
            array (
                'id' => 25,
                'uuid' => '2104e59e-8057-46d8-bd3a-02dbed8792f4',
                'name' => 'Management',
                'slug' => 'management',
                'parent_id' => 5,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 25,
                'created_at' => '2019-07-10 11:29:38',
                'updated_at' => '2019-07-10 11:29:38',
            ),
            23 => 
            array (
                'id' => 26,
                'uuid' => '5d82d8d8-60a7-4c46-b85f-205fb23cf747',
                'name' => 'Sales',
                'slug' => 'sales',
                'parent_id' => 5,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 26,
                'created_at' => '2019-07-10 11:29:57',
                'updated_at' => '2019-07-10 11:29:57',
            ),
            24 => 
            array (
                'id' => 27,
                'uuid' => 'e4cc8b1e-17c2-4c8f-8795-b79de0e12aef',
                'name' => 'Data and Analytics',
                'slug' => 'data-and-analytics',
                'parent_id' => 5,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 27,
                'created_at' => '2019-07-10 11:30:07',
                'updated_at' => '2019-07-10 11:30:07',
            ),
            25 => 
            array (
                'id' => 28,
                'uuid' => '1ebc102a-9993-4595-91fb-a9230dba9ce4',
                'name' => 'Web Design',
                'slug' => 'web-design',
                'parent_id' => 7,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 28,
                'created_at' => '2019-07-10 11:31:12',
                'updated_at' => '2019-07-10 11:31:12',
            ),
            26 => 
            array (
                'id' => 29,
                'uuid' => '4a620c08-f650-44dd-b8e9-9b49010df27a',
                'name' => '3D and Animation',
                'slug' => '3d-and-animation',
                'parent_id' => 7,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 29,
                'created_at' => '2019-07-10 11:31:32',
                'updated_at' => '2019-07-10 11:31:32',
            ),
            27 => 
            array (
                'id' => 30,
                'uuid' => '4b543cd2-6fd0-4162-8dc5-2e73405b2e5b',
                'name' => 'Fashion',
                'slug' => 'fashion',
                'parent_id' => 7,
                'image' => NULL,
                'live' => 1,
                'sortOrder' => 30,
                'created_at' => '2019-07-10 11:31:41',
                'updated_at' => '2019-07-10 11:31:41',
            ),
        ));
        
        //$this->enableForeignKeys();
        
    }
}