<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sections')->delete();
        
        \DB::table('sections')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => '14255267-6702-46dd-a0f9-4fa22ded5f3f',
                'course_id' => 1,
                'title' => 'Occaecati Accusantium Ipsa Id Sed Aut Voluptas Laudantium.',
                'objective' => 'Odit Voluptas Error Ullam Aut Eum Velit Atque.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            1 => 
            array (
                'id' => 2,
                'uuid' => '75063544-8d53-4255-bf76-8a52a836889c',
                'course_id' => 1,
                'title' => 'Et Consequatur Aspernatur Voluptatem Mollitia.',
                'objective' => 'Unde Laudantium Ad Totam Quis Minima Quod Magnam.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            2 => 
            array (
                'id' => 3,
                'uuid' => '7c9cea0f-970b-4289-a594-a36d2d9fc6f4',
                'course_id' => 2,
                'title' => 'Neque Atque Laudantium Voluptates Natus Velit.',
                'objective' => 'Officiis Et Ipsam Assumenda Voluptate.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            3 => 
            array (
                'id' => 4,
                'uuid' => '0d14e24a-4ef0-4605-a084-54d2d868f8a3',
                'course_id' => 2,
                'title' => 'Omnis Necessitatibus Veritatis Est.',
                'objective' => 'Ut Et Dolor Minus Impedit Quidem Rem Accusantium.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            4 => 
            array (
                'id' => 5,
                'uuid' => '48e5c2f3-43a4-4549-a118-41c7c60755eb',
                'course_id' => 3,
                'title' => 'Voluptatem Ut Ratione Quo Est Quia Aut.',
                'objective' => 'Minima Accusantium Amet Veniam Eum Provident Nostrum.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            5 => 
            array (
                'id' => 6,
                'uuid' => 'f32f1799-db29-4aa0-9282-48ca6b85a52a',
                'course_id' => 3,
                'title' => 'Et Quis Aut Doloribus.',
                'objective' => 'Consequatur Ut Enim Porro.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            6 => 
            array (
                'id' => 7,
                'uuid' => 'c2ceb9d9-2329-4708-8c4b-eccaba59c48e',
                'course_id' => 4,
                'title' => 'Quo Neque Ducimus Sit Quia Quam.',
                'objective' => 'Odio Omnis Quidem Eius Aut In Error A.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            7 => 
            array (
                'id' => 8,
                'uuid' => 'e2181f49-d9da-4db8-a009-74ab4cf1d635',
                'course_id' => 4,
                'title' => 'Sequi Voluptatibus Repellat Odit Voluptatem Nemo.',
                'objective' => 'Iste Quia Minima Aut Incidunt Blanditiis Nisi.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            8 => 
            array (
                'id' => 9,
                'uuid' => '2f6999e6-06af-4750-ba5c-c4d5b17d3d92',
                'course_id' => 5,
                'title' => 'Voluptas Id Voluptas Corrupti Officiis Quas.',
                'objective' => 'Cum Assumenda Maxime Illum Aut.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            9 => 
            array (
                'id' => 10,
                'uuid' => '380610df-104b-48f2-a7d7-783263f2def5',
                'course_id' => 5,
                'title' => 'Id Exercitationem Eveniet Consequatur Eum Delectus.',
                'objective' => 'Eaque Excepturi Natus Et Quam Laboriosam Quibusdam.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            10 => 
            array (
                'id' => 11,
                'uuid' => '3ba155da-8f71-4170-bbf1-de3695290263',
                'course_id' => 6,
                'title' => 'Et Cumque Voluptas Est.',
                'objective' => 'Unde Enim Deleniti Dolores Quia Nemo.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            11 => 
            array (
                'id' => 12,
                'uuid' => '50d7b436-d515-4730-a1ff-f56ce759ee3b',
                'course_id' => 6,
                'title' => 'Ducimus Laborum Consequatur Eveniet Maiores Quaerat.',
                'objective' => 'Officia Earum Dignissimos Itaque Deleniti Eum.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            12 => 
            array (
                'id' => 13,
                'uuid' => 'c3cd8d1b-7a37-498f-bf7a-cfacfa18f04b',
                'course_id' => 7,
                'title' => 'Ut Odio Dolore Iure Veniam Sit.',
                'objective' => 'Accusantium Minus Et Iure Ea Quia Nemo Fuga.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            13 => 
            array (
                'id' => 14,
                'uuid' => '899b7751-57b3-4aea-99a8-f19c34eece33',
                'course_id' => 7,
                'title' => 'Cumque Fugit Repudiandae Ad Vero Qui Amet Assumenda.',
                'objective' => 'Dolorem Dolorem Excepturi Quia Repellat Dolor Veritatis.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:36:45',
            ),
            14 => 
            array (
                'id' => 15,
                'uuid' => '39836bf7-dbbf-4e70-989d-19d3075b4ebc',
                'course_id' => 8,
                'title' => 'Qui Accusamus Ratione Odit Recusandae Possimus.',
                'objective' => 'Numquam Fuga Vel Eaque Quis.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            15 => 
            array (
                'id' => 16,
                'uuid' => '042adf58-dd51-4cde-9b7c-2b650c8af2fe',
                'course_id' => 8,
                'title' => 'Cumque Ipsam Corrupti Labore Accusantium.',
                'objective' => 'Et Quas Assumenda Ad Aperiam Et.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            16 => 
            array (
                'id' => 17,
                'uuid' => 'c24d360e-0857-4462-897d-d31fb17da7fb',
                'course_id' => 9,
                'title' => 'Quia Enim Perferendis Accusamus Sed Eveniet Adipisci Velit Voluptatibus.',
                'objective' => 'Unde Non Sed Dolores Aut Quaerat Non Officia.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            17 => 
            array (
                'id' => 18,
                'uuid' => '7b0f49bf-ec7e-4f15-b194-20cac309cf37',
                'course_id' => 9,
                'title' => 'Fugit Ea Perspiciatis Quidem Reiciendis.',
                'objective' => 'Non Non Dolorem Nobis Dolores Exercitationem.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            18 => 
            array (
                'id' => 19,
                'uuid' => 'de77d2e8-6b72-4c72-b190-f173dd10cb08',
                'course_id' => 10,
                'title' => 'Qui Consequatur Aut Quam Quia Consectetur.',
                'objective' => 'Labore Et Optio Harum Omnis.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            19 => 
            array (
                'id' => 20,
                'uuid' => 'f0d50435-98b7-43a0-b37a-a3976a144657',
                'course_id' => 10,
                'title' => 'Eos Qui Velit Ea Nemo Accusantium Veniam.',
                'objective' => 'Et Tempora Deleniti Et Voluptatem Deserunt Repudiandae.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            20 => 
            array (
                'id' => 21,
                'uuid' => 'ea50886e-0204-43a3-b065-60705c5e1e2d',
                'course_id' => 11,
                'title' => 'Fuga Vero Voluptatem Vero Quam Hic Perferendis.',
                'objective' => 'Nulla Autem Sint Nam Voluptatem.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            21 => 
            array (
                'id' => 22,
                'uuid' => '138ab49d-5530-498e-bf5b-8ac7deb8506b',
                'course_id' => 11,
                'title' => 'Atque Aut Nulla Rerum Nostrum Nobis Ad Deserunt.',
                'objective' => 'Quia Praesentium Error Voluptatem Est Consequatur Temporibus Optio.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            22 => 
            array (
                'id' => 23,
                'uuid' => 'ea81dd9f-4941-40ef-8a65-3412c59a9cb8',
                'course_id' => 12,
                'title' => 'Provident Eos Id Eligendi.',
                'objective' => 'Dolorem Quas Ut Eveniet Sit Consequuntur Reprehenderit.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            23 => 
            array (
                'id' => 24,
                'uuid' => 'adb78063-8175-4ac9-ba57-482128331d5d',
                'course_id' => 12,
                'title' => 'Dolor Dolore Qui Dolorem Accusamus Recusandae Esse.',
                'objective' => 'Temporibus Vitae Laborum Ullam Qui.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            24 => 
            array (
                'id' => 25,
                'uuid' => '11898836-f54b-42a3-b514-5a221a3c996f',
                'course_id' => 13,
                'title' => 'Et Esse Accusamus Et Dolor.',
                'objective' => 'Ipsa Labore Voluptatem Dolores Id Iste Qui.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            25 => 
            array (
                'id' => 26,
                'uuid' => 'c8af9864-d8ab-4e53-9738-2eb2950cd501',
                'course_id' => 13,
                'title' => 'Sit Asperiores Exercitationem Id.',
                'objective' => 'Voluptatem Voluptatum Sunt Velit Et Nesciunt Et Voluptate.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            26 => 
            array (
                'id' => 27,
                'uuid' => '84cb4d80-15f9-487c-910f-8981aeafdd33',
                'course_id' => 14,
                'title' => 'Repellendus Non Repudiandae Recusandae Vitae Assumenda Laborum.',
                'objective' => 'Pariatur Quod Qui Quis.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            27 => 
            array (
                'id' => 28,
                'uuid' => 'a98e3770-f750-4d0c-b80b-114f8b5f3420',
                'course_id' => 14,
                'title' => 'Dolore Sit Praesentium Quia Reiciendis Tempora.',
                'objective' => 'Qui Eos Assumenda Quos Quasi Culpa Reiciendis.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            28 => 
            array (
                'id' => 29,
                'uuid' => '8ac66ec9-e7b5-4d6f-b367-06fccbd0b6d7',
                'course_id' => 15,
                'title' => 'Ea Dolorem Est Alias Vel Adipisci.',
                'objective' => 'Ea Non Et Dolores Quae Quia Numquam Odit.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            29 => 
            array (
                'id' => 30,
                'uuid' => 'a25b3750-87c3-4818-b860-2304fb0d4a0c',
                'course_id' => 15,
                'title' => 'Modi Rem Libero Corporis Amet Itaque Magni Quia.',
                'objective' => 'Enim Placeat Dolorem Ut Et Numquam Cumque Et.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:36:58',
            ),
            30 => 
            array (
                'id' => 31,
                'uuid' => 'a402082e-f855-4f75-bbb8-485f7e8b9699',
                'course_id' => 16,
                'title' => 'Adipisci Maxime Nam Id Hic Sed.',
                'objective' => 'Expedita Aut Eaque Vel.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:05',
            ),
            31 => 
            array (
                'id' => 32,
                'uuid' => 'f49f90fa-06d8-4104-92b1-ef4f81846543',
                'course_id' => 16,
                'title' => 'Dolorem Eius Reprehenderit Totam Accusamus Labore Voluptas.',
                'objective' => 'Et Dolor Non Mollitia Doloremque Saepe Et Blanditiis.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:05',
            ),
            32 => 
            array (
                'id' => 33,
                'uuid' => '98fd87ad-e501-4061-9f4e-04a1fa4b94e8',
                'course_id' => 17,
                'title' => 'Facilis Cumque Explicabo Ex Sint Rerum Laudantium.',
                'objective' => 'Quisquam Ratione Ipsa Nesciunt Occaecati Impedit.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:05',
            ),
            33 => 
            array (
                'id' => 34,
                'uuid' => '8f2c56f0-0147-43de-9b06-3fde5d2fd9af',
                'course_id' => 17,
                'title' => 'Et Sed Dolorem Fuga Architecto Pariatur Veniam Autem Aut.',
                'objective' => 'Corrupti Ratione Officiis Et Vel Molestiae Repellat Cupiditate.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:05',
            ),
            34 => 
            array (
                'id' => 35,
                'uuid' => '6f3a731d-7e5c-433e-9aec-3f83e60e76b4',
                'course_id' => 18,
                'title' => 'Dolor Consequatur Voluptas Amet Autem Aut Suscipit.',
                'objective' => 'Quia Qui Quis Praesentium Harum.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:05',
            ),
            35 => 
            array (
                'id' => 36,
                'uuid' => '16384aa2-e24d-4d6b-9b3e-7eeb56aa11ba',
                'course_id' => 18,
                'title' => 'Et Totam Velit Deleniti Tenetur Quia.',
                'objective' => 'Officiis Exercitationem Cupiditate Aut Quidem.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:05',
            ),
            36 => 
            array (
                'id' => 37,
                'uuid' => '577a2328-c1db-4803-83de-bdbb9a1bc02a',
                'course_id' => 19,
                'title' => 'Incidunt Labore Omnis Nulla Et Enim.',
                'objective' => 'Doloribus Nobis Vel Deserunt.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:05',
            ),
            37 => 
            array (
                'id' => 38,
                'uuid' => 'c628042b-2e1f-4892-aee8-0c3c0f7d5593',
                'course_id' => 19,
                'title' => 'Qui Sed Est Sed Itaque.',
                'objective' => 'Commodi Fugit Impedit Qui Voluptate Adipisci.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:05',
            ),
            38 => 
            array (
                'id' => 39,
                'uuid' => '74634876-a94f-4f65-913e-c21c57289844',
                'course_id' => 20,
                'title' => 'Sint Itaque Soluta Quas Iste Et.',
                'objective' => 'Vero Corrupti Animi Pariatur Aut Modi.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:05',
            ),
            39 => 
            array (
                'id' => 40,
                'uuid' => '110361cb-faca-49c5-8f50-d9de308ea097',
                'course_id' => 20,
                'title' => 'Iste Doloremque Sed Consequatur Et Voluptatem Eveniet Alias Sint.',
                'objective' => 'Dolorem Inventore Possimus Sed Repellendus.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:05',
            ),
            40 => 
            array (
                'id' => 41,
                'uuid' => '05006f49-b6f4-4bca-ad6b-e0a44c55e7bb',
                'course_id' => 21,
                'title' => 'Sunt Qui Aliquam Voluptatem Ut.',
                'objective' => 'Sed Corrupti Sequi Facilis Natus Dignissimos Sed.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:37:15',
                'updated_at' => '2019-09-26 21:37:15',
            ),
            41 => 
            array (
                'id' => 42,
                'uuid' => '0dadd663-0849-429b-8ef2-e134f2b32570',
                'course_id' => 21,
                'title' => 'Sunt Commodi Dignissimos Autem Sint Alias.',
                'objective' => 'Dolores Consequuntur Voluptatum Voluptas Totam.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:37:15',
                'updated_at' => '2019-09-26 21:37:15',
            ),
            42 => 
            array (
                'id' => 43,
                'uuid' => '19d42379-170f-4641-ae19-a4f668d69611',
                'course_id' => 22,
                'title' => 'Aut Aut Quia Quia Ab.',
                'objective' => 'Eum Blanditiis Quisquam Reprehenderit Ex.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:37:16',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            43 => 
            array (
                'id' => 44,
                'uuid' => 'ee7cb465-91f4-447d-9049-a571c764c11d',
                'course_id' => 22,
                'title' => 'Sed Voluptates Magnam Quos Sit Non.',
                'objective' => 'Laborum Dignissimos Voluptas Aut Quis Cumque Ea Dolor.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:37:16',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            44 => 
            array (
                'id' => 45,
                'uuid' => '5bc138d4-3bf7-48c1-a117-50f8ff464ced',
                'course_id' => 23,
                'title' => 'Ipsum Suscipit Aliquid Ad Delectus Nobis.',
                'objective' => 'Laudantium Ratione Ut Et Tempore Consectetur Eos.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:37:16',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            45 => 
            array (
                'id' => 46,
                'uuid' => 'e3eeffab-0295-4f43-acc3-1d38f0c9c39f',
                'course_id' => 23,
                'title' => 'Deserunt Dolor Corrupti Et Illum Sapiente.',
                'objective' => 'Ex Quibusdam Eos Occaecati.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:37:16',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            46 => 
            array (
                'id' => 47,
                'uuid' => '172e77d4-599b-4c05-8571-ab4fc2d20032',
                'course_id' => 24,
                'title' => 'Eligendi Voluptate Qui Odit Accusantium Reprehenderit Ut Qui Ipsa.',
                'objective' => 'Fugiat Delectus Consequuntur Odio Labore.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:37:16',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            47 => 
            array (
                'id' => 48,
                'uuid' => '1d343f23-e048-41d5-a99c-7331f364f6d3',
                'course_id' => 24,
                'title' => 'Sequi Nam Voluptate Fuga Deserunt.',
                'objective' => 'Sit Voluptatem Ea Ducimus Tempora Doloremque.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:37:16',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            48 => 
            array (
                'id' => 49,
                'uuid' => '184f8575-85e4-4522-8b19-ed790151ae04',
                'course_id' => 25,
                'title' => 'Sequi Cupiditate Corrupti Quas Quae Ullam Porro Consequatur.',
                'objective' => 'Dignissimos Voluptas Esse Tempora Ut Minus Excepturi Inventore.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:37:16',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            49 => 
            array (
                'id' => 50,
                'uuid' => 'dc591677-3f24-457c-8203-b6f16c1bcda4',
                'course_id' => 25,
                'title' => 'Omnis Odio Assumenda Iste Mollitia Qui.',
                'objective' => 'Veritatis Ullam Inventore Molestias Vero Dolores Eius Quasi.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:37:16',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            50 => 
            array (
                'id' => 51,
                'uuid' => '9b95f606-2a56-462b-8812-bf961cd63d15',
                'course_id' => 26,
                'title' => 'Et Expedita Et Et Ut Blanditiis Quo Explicabo.',
                'objective' => 'Sint Dolorem Temporibus Deserunt.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:37:16',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            51 => 
            array (
                'id' => 52,
                'uuid' => '33087a36-c7e8-49d1-8e43-472c9d935b1a',
                'course_id' => 26,
                'title' => 'Vel Magnam Veniam Aut Et.',
                'objective' => 'Tenetur Ea Minus Facere Quia Dolore Quas Provident.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:37:16',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            52 => 
            array (
                'id' => 53,
                'uuid' => 'bd5f796b-c3f4-42ad-97c6-8654f35d58de',
                'course_id' => 27,
                'title' => 'Est Voluptatem Corrupti Provident Modi Maiores Mollitia Eos.',
                'objective' => 'Est Quaerat Ut Molestias Tempora Incidunt.',
                'sortOrder' => 2,
                'created_at' => '2019-09-26 21:37:16',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            53 => 
            array (
                'id' => 54,
                'uuid' => 'eb8f7f0b-d963-47c2-9cce-9d49d094efc8',
                'course_id' => 27,
                'title' => 'Sapiente Sed Id Sapiente Consequatur.',
                'objective' => 'Dolore Sit Doloremque Et Sint Ea.',
                'sortOrder' => 3,
                'created_at' => '2019-09-26 21:37:16',
                'updated_at' => '2019-09-26 21:37:16',
            ),
        ));
        
        
    }
}