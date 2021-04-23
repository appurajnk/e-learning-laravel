<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('courses')->delete();
        
        \DB::table('courses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => '88a134bf-2c33-4153-a2f6-e1c256d5a147',
                'user_id' => 2,
                'category_id' => 4,
                'title' => 'Quae Saepe Exercitationem Repudiandae Rem Quis.',
                'subtitle' => 'Nihil Qui Ipsum Illum Laudantium.',
                'slug' => 'quae-saepe-exercitationem-repudiandae-rem-quis',
                'description' => 'Facere architecto tempora omnis non magni quo quam ab. Aliquam distinctio dolorum asperiores qui quaerat doloribus voluptates. Veniam ut sit aut sapiente magnam. Impedit assumenda esse autem consequatur quia sit. Ipsam corrupti quo facere.

Voluptatibus omnis rerum vel sint. Eligendi error et eius sit labore. Est minima cupiditate ducimus nihil similique. Autem quia quaerat repudiandae quis quos animi recusandae.',
                'language' => 'French',
                'image' => '80099bd04640cbd27949b8f8174464f5.jpg',
                'level' => 'all',
                'featured' => 0,
                'price' => '170.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.1,"durationHMS":"00:12:00","total_articles":2,"total_hours":0.2,"total_published_lessons":5,"total_lessons":5,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            1 => 
            array (
                'id' => 2,
                'uuid' => 'a4fd96a9-95f1-4de5-bfb1-996d396dbb74',
                'user_id' => 2,
                'category_id' => 18,
                'title' => 'Doloribus Qui Totam Et Rerum Consequatur Iusto.',
                'subtitle' => 'Nemo Qui Perferendis Voluptates.',
                'slug' => 'doloribus-qui-totam-et-rerum-consequatur-iusto',
                'description' => 'Repudiandae voluptatem veniam aut. Non et sint aut error est culpa sapiente quibusdam. Ratione eaque incidunt reiciendis.

Ea dolores molestias consequatur deleniti odio voluptas. Quia dolore iste aut est sint. Molestiae aut minima tempore. Molestiae autem cumque tempore.',
                'language' => 'Spanish',
                'image' => '2f49b85d5a4e632836fcb932cf2f4eac.jpg',
                'level' => 'intermediate',
                'featured' => 0,
                'price' => '162.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.4,"durationHMS":"00:30:00","total_articles":3,"total_hours":0.5,"total_published_lessons":8,"total_lessons":8,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            2 => 
            array (
                'id' => 3,
                'uuid' => '3b924977-da13-41d9-860d-37022279d0ad',
                'user_id' => 2,
                'category_id' => 23,
                'title' => 'Temporibus Officia Consequatur Non Dicta Non Vitae Non.',
                'subtitle' => 'Nemo Id Voluptas Dicta Similique Quis Ab Nisi.',
                'slug' => 'temporibus-officia-consequatur-non-dicta-non-vitae-non',
                'description' => 'Ut aut ut sit eos et labore modi et. Iure labore dolor sit cupiditate qui dolorum sit nam. Qui incidunt vel quibusdam aut quam tempora. Minus magni magnam corrupti aut porro consequuntur sunt qui.

Mollitia sapiente totam quos. Ut explicabo fugit et magnam fugiat. Distinctio odit eius architecto harum animi et asperiores.',
                'language' => 'French',
                'image' => '2c4999eb14032fe4fbd86842a42c2bba.jpg',
                'level' => 'beginner',
                'featured' => 0,
                'price' => '72.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.2,"durationHMS":"00:24:00","total_articles":3,"total_hours":0.4,"total_published_lessons":6,"total_lessons":6,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            3 => 
            array (
                'id' => 4,
                'uuid' => '56446753-5ca9-433b-8ef9-e34356d12796',
                'user_id' => 2,
                'category_id' => 9,
                'title' => 'Voluptates Accusamus Et Odio Qui Praesentium Mollitia Quisquam.',
                'subtitle' => 'Reprehenderit Aut Est Aut Nobis Quis.',
                'slug' => 'voluptates-accusamus-et-odio-qui-praesentium-mollitia-quisquam',
                'description' => 'Non perspiciatis cumque quos dolor. Animi quo et voluptas aut accusantium voluptatem et aperiam. Qui reiciendis cupiditate tempora sed rerum.

Voluptatum harum quis perferendis. Eaque voluptas at exercitationem perferendis aperiam ut itaque similique. Possimus hic nam debitis vel.',
                'language' => 'English',
                'image' => '316d3e6aef4a65169a96fdf65e33c6e0.jpg',
                'level' => 'intermediate',
                'featured' => 0,
                'price' => '177.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.3,"durationHMS":"00:30:00","total_articles":2,"total_hours":0.5,"total_published_lessons":5,"total_lessons":5,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            4 => 
            array (
                'id' => 5,
                'uuid' => '82c251da-169f-401f-b842-47e0b987a906',
                'user_id' => 2,
                'category_id' => 8,
                'title' => 'Vero Excepturi Illo Minus Veniam Hic Perspiciatis.',
                'subtitle' => 'Libero Veniam Non Laborum Aut.',
                'slug' => 'vero-excepturi-illo-minus-veniam-hic-perspiciatis',
                'description' => 'Aut repellendus est aliquid voluptatem. Similique aliquid sed fugit aliquid est. Quam id esse aut voluptatem eos nihil.

Qui quae dolorem omnis perferendis. Vel ipsum similique nam iure ut. At quis ratione et. Sed sit exercitationem quis itaque nulla.

Molestiae numquam minus reiciendis est veritatis. Ex laudantium sunt quia temporibus aut amet blanditiis. Sed quidem provident est. Optio sapiente veniam quia et aut qui qui.

Et sunt sit laboriosam molestiae. Libero modi doloremque aut temporibus iusto dicta maiores alias.',
                'language' => 'French',
                'image' => '3221499876ba225383a53e514d8fdeff.jpg',
                'level' => 'all',
                'featured' => 0,
                'price' => '85.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.5,"durationHMS":"00:42:00","total_articles":1,"total_hours":0.7,"total_published_lessons":7,"total_lessons":7,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            5 => 
            array (
                'id' => 6,
                'uuid' => '65ef98c0-7b47-427c-9ee6-51f0cccb8e24',
                'user_id' => 2,
                'category_id' => 27,
                'title' => 'Et Quisquam Porro Blanditiis Reiciendis Nihil Sint.',
                'subtitle' => 'Est Excepturi Eaque Eos.',
                'slug' => 'et-quisquam-porro-blanditiis-reiciendis-nihil-sint',
                'description' => 'Praesentium voluptatem qui animi voluptas libero quia similique. Voluptate molestiae perspiciatis pariatur similique aut. Id ipsam nobis provident officia aut vel. Occaecati et est deserunt non unde sunt eum unde.

Voluptatem eum est voluptatem nisi sit autem. Consequatur sed tempora necessitatibus soluta nam reprehenderit molestiae. Dignissimos commodi ipsam ut est.

Possimus itaque doloremque est aliquid laborum. Reprehenderit aut cumque et in molestiae aut voluptatibus. Sequi modi velit est laboriosam voluptatem est.

Molestiae minus soluta aspernatur velit recusandae ut laboriosam. Omnis accusantium quidem et cumque. Deserunt quisquam ipsa et inventore distinctio fugiat blanditiis. Sed cumque ea quia minima nesciunt ipsa nulla.',
                'language' => 'Spanish',
                'image' => '239c334e5bd24876f479cc2f1023c21a.jpg',
                'level' => 'intermediate',
                'featured' => 0,
                'price' => '161.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.5,"durationHMS":"00:42:00","total_articles":2,"total_hours":0.7,"total_published_lessons":6,"total_lessons":6,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            6 => 
            array (
                'id' => 7,
                'uuid' => '07fa6d94-7dda-455f-933f-a928117e0f78',
                'user_id' => 2,
                'category_id' => 22,
                'title' => 'Et Aut Dolore Consequatur Atque In Illum Enim.',
                'subtitle' => 'Et Qui Voluptas Aperiam Ut.',
                'slug' => 'et-aut-dolore-consequatur-atque-in-illum-enim',
                'description' => 'Repellendus ut beatae sed adipisci. Aut voluptas voluptas debitis ipsa. Architecto reprehenderit qui sapiente. Neque eum delectus illo dolor. Quibusdam voluptatum beatae corporis.

Reiciendis hic sit aut rem quibusdam perferendis et. Sunt minima possimus quisquam rerum quo omnis hic. Aut laudantium omnis aspernatur ducimus nesciunt.',
                'language' => 'English',
                'image' => '211b77234ace3e13d5675bb36a8de9a5.jpg',
                'level' => 'advanced',
                'featured' => 0,
                'price' => '2.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.3,"durationHMS":"00:18:00","total_articles":0,"total_hours":0.3,"total_published_lessons":4,"total_lessons":4,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:45',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            7 => 
            array (
                'id' => 8,
                'uuid' => 'c529f5bc-b697-41ea-bf67-81a53fdc26bb',
                'user_id' => 3,
                'category_id' => 4,
                'title' => 'Adipisci Nulla Ad Accusamus In Est.',
                'subtitle' => 'Quae Facere Perspiciatis Aut Ut.',
                'slug' => 'adipisci-nulla-ad-accusamus-in-est',
                'description' => 'Qui amet quaerat aut cumque ut. Et molestias est aut explicabo vel.

Id suscipit voluptatem perferendis sint itaque. Non sapiente nemo repellendus nostrum repudiandae. Corporis est sed vitae et aut. Ab molestiae reprehenderit aut velit ipsum est consequatur.

Enim et et ipsa voluptas. Est dolor laborum quasi vel. Est omnis autem recusandae iure vero ad. Ad enim corporis et necessitatibus similique sint. Enim distinctio optio sequi omnis iure sapiente.',
                'language' => 'English',
                'image' => '99d816467acf76dbc324ec040696a55f.jpg',
                'level' => 'beginner',
                'featured' => 0,
                'price' => '13.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0,"durationHMS":"00:36:00","total_articles":4,"total_hours":0.6,"total_published_lessons":4,"total_lessons":4,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            8 => 
            array (
                'id' => 9,
                'uuid' => '77dd01b7-7b38-4542-8bc7-01fe4011b0d5',
                'user_id' => 3,
                'category_id' => 21,
                'title' => 'Eos Sit Modi Sed.',
                'subtitle' => 'Ipsam Est Illo Ea Quisquam.',
                'slug' => 'eos-sit-modi-sed',
                'description' => 'Placeat sint laudantium consequuntur dolorem sequi commodi. Exercitationem ut in ducimus. Harum ut officia non soluta quod.

Laborum nam ab veritatis qui ullam qui enim. Nihil quia debitis aut quibusdam quos. Molestiae facere culpa soluta sed. Numquam eos sit aut aut alias.

Quaerat vel odio ex consequuntur. Nulla aut accusamus ea voluptates placeat. Voluptas nesciunt voluptate culpa numquam sunt ipsum dolor. Voluptatem molestias quae voluptate id deleniti voluptatem est totam.

Hic rem dignissimos ullam ut consequatur. Ea et ullam eum enim veniam dolorem. Accusamus magnam fugit dolorem qui repudiandae ut.',
                'language' => 'English',
                'image' => '5045651da37ec50f924fe93a64dba6fc.jpg',
                'level' => 'advanced',
                'featured' => 0,
                'price' => '44.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.3,"durationHMS":"00:42:00","total_articles":3,"total_hours":0.7,"total_published_lessons":7,"total_lessons":7,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            9 => 
            array (
                'id' => 10,
                'uuid' => '0c5373e3-1064-4583-8b14-f7b48ab00207',
                'user_id' => 3,
                'category_id' => 3,
                'title' => 'Sint Et Ipsam Molestiae Eos Non Veniam Error.',
                'subtitle' => 'Voluptates Voluptatem Repudiandae Odio Consequatur Explicabo Omnis Natus.',
                'slug' => 'sint-et-ipsam-molestiae-eos-non-veniam-error',
                'description' => 'Enim in ea vel. Ut sit nisi in nulla blanditiis quia laborum voluptate. A sed excepturi laudantium magnam et soluta ut.

Aliquid inventore autem qui corrupti eum sit expedita. Est eaque minus exercitationem nesciunt quaerat saepe neque. Libero est error voluptatem ut ut autem quos quia.

Est magnam cum sunt rerum ipsam quis. Laborum deleniti eaque hic. Sunt cupiditate ut enim dolorem sit. Ratione aut a consequuntur sunt doloremque. Nam in fuga impedit harum.

Consectetur quo est qui sint quae. Maiores quod tempore quia dicta occaecati. Dignissimos voluptas praesentium dignissimos iste aperiam voluptatem quibusdam.',
                'language' => 'English',
                'image' => 'd635cb2ca27cf6a7147724bd9cfb4846.jpg',
                'level' => 'all',
                'featured' => 0,
                'price' => '56.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.3,"durationHMS":"00:36:00","total_articles":2,"total_hours":0.6,"total_published_lessons":6,"total_lessons":6,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            10 => 
            array (
                'id' => 11,
                'uuid' => 'e4bf0f5a-717f-4e66-a1b7-4550cf5ae8d7',
                'user_id' => 3,
                'category_id' => 18,
                'title' => 'Nihil Animi Facere Quis Rerum Nihil Odio.',
                'subtitle' => 'Et Voluptatum Voluptatem Saepe Aperiam Nemo Quo Sapiente Suscipit.',
                'slug' => 'nihil-animi-facere-quis-rerum-nihil-odio',
                'description' => 'Ut omnis et odio. Ut accusantium fugiat dolor. Nobis ut dolores eum saepe iure esse quasi. Dolorum quaerat voluptatibus id id voluptas.

Laudantium nemo soluta recusandae alias dolor. Quod aperiam quo quam accusamus sit sunt ipsa fugit. Voluptatem et aut quis laboriosam id vel sit. Qui sed quas aspernatur voluptas.

Ratione necessitatibus totam eum iusto voluptatem nemo rem. Et quam sunt sequi. Quisquam iste cupiditate fugit dolor in quia molestias. Est optio minima velit doloribus dolorem non voluptatem molestias.',
                'language' => 'English',
                'image' => '43174a2dc2eafde92cf8b0671736d641.jpg',
                'level' => 'beginner',
                'featured' => 0,
                'price' => '142.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.2,"durationHMS":"00:24:00","total_articles":2,"total_hours":0.4,"total_published_lessons":5,"total_lessons":5,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            11 => 
            array (
                'id' => 12,
                'uuid' => 'f3686554-43da-49ec-989b-58ead750394d',
                'user_id' => 3,
                'category_id' => 22,
                'title' => 'Qui Enim Ut Neque Quia Quia.',
                'subtitle' => 'Et Fugit Soluta Placeat Blanditiis.',
                'slug' => 'qui-enim-ut-neque-quia-quia',
                'description' => 'Molestias est itaque assumenda dolorem perferendis. Sequi quia repudiandae repudiandae odio ad modi. Consectetur aspernatur non hic dolor ipsa. Voluptatem quae consequatur adipisci eligendi repudiandae. Ipsam quas aut vero velit asperiores.

Tenetur eveniet autem consequuntur. Qui asperiores vitae atque et repellendus modi fugiat. Tempora dolores perspiciatis sit velit repellendus voluptatem. Omnis illum sint aut et.

Consectetur excepturi ut labore nobis. Ullam molestias assumenda quis ea molestias. Veniam est est ab sed ut delectus.',
                'language' => 'English',
                'image' => '898c8796d4711bf50e5eb74b646ea503.jpg',
                'level' => 'all',
                'featured' => 0,
                'price' => '128.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.3,"durationHMS":"00:36:00","total_articles":3,"total_hours":0.6,"total_published_lessons":6,"total_lessons":6,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            12 => 
            array (
                'id' => 13,
                'uuid' => 'f002a9d1-dcf3-41ac-b80b-494c1d46b8ee',
                'user_id' => 3,
                'category_id' => 2,
                'title' => 'Voluptatibus Sunt Dolor Rerum Necessitatibus Officia.',
                'subtitle' => 'Dicta Consequatur Asperiores Non Quia Ut Error.',
                'slug' => 'voluptatibus-sunt-dolor-rerum-necessitatibus-officia',
                'description' => 'Ea eos consequuntur ut sint. Nobis odio qui illo provident perspiciatis. Quae laboriosam quisquam ea ipsum odio rerum. Odit explicabo molestiae et.

Doloremque non quia qui accusantium. Molestias inventore quis molestiae rerum esse veritatis ipsam. Totam neque est eos et dignissimos magni. Sed doloribus eligendi molestias autem ab voluptatem porro.

Et facilis sapiente quas ex quae. Et velit accusamus culpa cumque exercitationem. Suscipit aut voluptates deserunt quod in architecto. Corporis eveniet modi hic autem laborum aliquam blanditiis.',
                'language' => 'French',
                'image' => 'e6eb87f12106113752a5d623836d84b5.jpg',
                'level' => 'beginner',
                'featured' => 0,
                'price' => '131.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.2,"durationHMS":"00:30:00","total_articles":3,"total_hours":0.5,"total_published_lessons":6,"total_lessons":6,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            13 => 
            array (
                'id' => 14,
                'uuid' => 'd1dbfd30-b757-4898-8285-bc337083a508',
                'user_id' => 3,
                'category_id' => 23,
                'title' => 'Culpa Aut Dolor Dolores.',
                'subtitle' => 'Perspiciatis Illo Reiciendis Est Impedit.',
                'slug' => 'culpa-aut-dolor-dolores',
                'description' => 'Saepe non quo ut dolore numquam. Autem voluptatem suscipit id doloribus vel dignissimos nihil. Aut distinctio autem cumque ut iure.

Laborum aperiam magnam odit commodi quidem corporis consequatur facilis. Aut illum eaque sapiente aspernatur repudiandae dolore. Rerum mollitia omnis odio nemo.',
                'language' => 'English',
                'image' => '5f3410208dbe130948365f5d3f378670.jpg',
                'level' => 'intermediate',
                'featured' => 0,
                'price' => '39.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.4,"durationHMS":"00:30:00","total_articles":1,"total_hours":0.5,"total_published_lessons":7,"total_lessons":7,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            14 => 
            array (
                'id' => 15,
                'uuid' => '7d96e391-fa6b-47f7-8056-8d4f523185b5',
                'user_id' => 3,
                'category_id' => 28,
                'title' => 'Autem Non Non Voluptas Quisquam Aut.',
                'subtitle' => 'Perferendis Qui Expedita Molestiae Tempora Voluptas.',
                'slug' => 'autem-non-non-voluptas-quisquam-aut',
                'description' => 'Qui architecto molestias animi consectetur. Ut eos quod ipsa aliquid magni placeat. Ipsa error accusamus vel ex eum eos laborum.

Sequi repellendus cum autem expedita. Eos sit ratione nemo. Vero voluptatum molestiae aut praesentium earum impedit. Consequatur rerum illum dolores non culpa ab consequatur.

Totam quia cupiditate quod perferendis repellendus autem voluptatem. Ut similique quia sed architecto odio sunt ut. Dolores consequuntur dicta tenetur sint est et doloribus deserunt.

Odio soluta eaque officiis quis laboriosam. Consequatur iusto aut dolores. Ipsum voluptas quaerat et sit soluta aut illum.',
                'language' => 'English',
                'image' => '7b661004efdfe377332a603bb1c5d90d.jpg',
                'level' => 'intermediate',
                'featured' => 0,
                'price' => '42.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.3,"durationHMS":"00:30:00","total_articles":4,"total_hours":0.5,"total_published_lessons":6,"total_lessons":6,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:36:58',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            15 => 
            array (
                'id' => 16,
                'uuid' => 'd520bf67-7cfd-4d68-a5f7-e4243df3d3e8',
                'user_id' => 4,
                'category_id' => 22,
                'title' => 'Inventore Distinctio Sint Sunt Consequuntur Aut In.',
                'subtitle' => 'Quis Illum Qui Inventore Qui Autem.',
                'slug' => 'inventore-distinctio-sint-sunt-consequuntur-aut-in',
                'description' => 'Vero quidem et modi commodi cupiditate. Quia laboriosam voluptatem illo animi. Inventore totam id unde officia vel sunt. Dicta et et architecto est dolorem.

Inventore velit perspiciatis nihil. Vero est recusandae et. Unde ducimus quia expedita rem assumenda similique.',
                'language' => 'Spanish',
                'image' => '885f663afef03496e73709ce4d96740f.jpg',
                'level' => 'advanced',
                'featured' => 0,
                'price' => '94.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.1,"durationHMS":"00:30:00","total_articles":3,"total_hours":0.5,"total_published_lessons":6,"total_lessons":6,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            16 => 
            array (
                'id' => 17,
                'uuid' => 'ca085f73-2832-4202-984c-0923588993dd',
                'user_id' => 4,
                'category_id' => 2,
                'title' => 'Sint Totam Odio Animi Vitae Facere Aspernatur Molestiae Velit.',
                'subtitle' => 'Est Voluptatem Consequuntur Quibusdam Ut.',
                'slug' => 'sint-totam-odio-animi-vitae-facere-aspernatur-molestiae-velit',
                'description' => 'Commodi sed sint aut amet at est voluptatem. Architecto numquam non architecto id sed nulla doloremque. Debitis ab amet unde fuga dolor voluptas. Est omnis et et possimus ad error et.

Minima ipsum distinctio beatae accusantium ut deleniti ex molestiae. Aut est minus in facere velit sit voluptas sit. Explicabo et delectus tempora qui autem assumenda aliquid. Illum aspernatur dolores itaque deleniti sed et nulla.

Cupiditate corrupti et occaecati maiores ut. Quo sequi nisi ea voluptatibus quae. Qui magni magnam rerum nostrum. Neque in rem qui est et ut fuga voluptatem.

Et officiis culpa dolor et quae culpa quas. Error omnis laborum necessitatibus occaecati facere optio excepturi ab. Eaque non explicabo voluptas molestiae veniam. Facilis optio culpa voluptatibus.',
                'language' => 'French',
                'image' => '46511a1f7e053efc52423599f3343853.jpg',
                'level' => 'intermediate',
                'featured' => 0,
                'price' => '151.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.3,"durationHMS":"00:24:00","total_articles":2,"total_hours":0.4,"total_published_lessons":5,"total_lessons":5,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            17 => 
            array (
                'id' => 18,
                'uuid' => '438a03fa-136e-4d05-ac69-91bf4d4018aa',
                'user_id' => 4,
                'category_id' => 3,
                'title' => 'Voluptatum Est Quod Eveniet Officia Id Consequuntur.',
                'subtitle' => 'Aliquid Consequuntur Doloremque Tenetur Ut Sint.',
                'slug' => 'voluptatum-est-quod-eveniet-officia-id-consequuntur',
                'description' => 'Eos et et quam in incidunt facere in. Soluta sed sint numquam illum aut. Aut corrupti amet omnis delectus et. Harum labore ab doloremque laboriosam fugit unde sint.

Exercitationem a consequatur ipsa. Sunt perferendis qui maxime quisquam culpa sapiente et.',
                'language' => 'Spanish',
                'image' => '473ce42a66aea9f05ee62ca1ca494955.jpg',
                'level' => 'advanced',
                'featured' => 0,
                'price' => '177.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.3,"durationHMS":"00:30:00","total_articles":1,"total_hours":0.5,"total_published_lessons":5,"total_lessons":5,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            18 => 
            array (
                'id' => 19,
                'uuid' => '34b3d390-558c-4216-8a36-fa28f00091f1',
                'user_id' => 4,
                'category_id' => 22,
                'title' => 'Minima Quia Maiores Reiciendis Accusantium Ducimus Corporis Nulla.',
                'subtitle' => 'Doloribus Tempora Saepe Eos Qui Officia.',
                'slug' => 'minima-quia-maiores-reiciendis-accusantium-ducimus-corporis-nulla',
                'description' => 'Sit quia placeat quisquam natus et mollitia beatae et. Quod minus sunt ut dignissimos tempore eligendi. Provident reprehenderit molestiae praesentium culpa id. Qui a qui culpa est. Id omnis aliquam vero eveniet.

Explicabo dolor maxime magnam sed nobis molestiae perferendis. Exercitationem quis et earum quis et. Est suscipit rerum et et. Ullam dolorem numquam numquam recusandae dolorem tempora. Ex natus dolorem corporis dolor nesciunt.

Dolorem provident exercitationem et dicta saepe. Adipisci itaque sit voluptatum aliquam voluptas sunt omnis. Dolorum ut sunt voluptatem ex dolorem nihil. Facere non at quia dolor expedita exercitationem.',
                'language' => 'English',
                'image' => '4eb8eedf20b694db1e5604770e07ce08.jpg',
                'level' => 'all',
                'featured' => 0,
                'price' => '143.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.3,"durationHMS":"00:30:00","total_articles":1,"total_hours":0.5,"total_published_lessons":7,"total_lessons":7,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            19 => 
            array (
                'id' => 20,
                'uuid' => 'bd3418e8-3bfd-4da1-b3ae-94678cb70437',
                'user_id' => 4,
                'category_id' => 29,
                'title' => 'Quos Delectus Suscipit Reprehenderit Et Id Ad.',
                'subtitle' => 'Alias Numquam Libero Nesciunt Tenetur Aut.',
                'slug' => 'quos-delectus-suscipit-reprehenderit-et-id-ad',
                'description' => 'Voluptatum explicabo quisquam iusto perferendis suscipit. Est et deleniti sunt amet dolores. Nihil in delectus nihil assumenda quam exercitationem.

Perspiciatis quis qui ipsa aliquam velit unde reprehenderit. Aspernatur repudiandae beatae ut. Necessitatibus iste amet perspiciatis perspiciatis dolorem. Quis nihil velit sapiente itaque pariatur laboriosam.

Maiores commodi et quos et dolore distinctio error tempora. Est commodi facere fugiat aut optio ut distinctio. Enim vel quibusdam voluptas. Molestias sit consectetur facere labore qui sed facilis consequuntur.',
                'language' => 'French',
                'image' => '61201e4e497b32144030c957b3865802.jpg',
                'level' => 'beginner',
                'featured' => 0,
                'price' => '123.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.3,"durationHMS":"00:18:00","total_articles":2,"total_hours":0.3,"total_published_lessons":5,"total_lessons":5,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:37:05',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            20 => 
            array (
                'id' => 21,
                'uuid' => '80491c46-11dd-4973-93c5-958ea5b278f3',
                'user_id' => 5,
                'category_id' => 22,
                'title' => 'Aliquam Consequuntur Ab Et Veritatis Quibusdam Laborum.',
                'subtitle' => 'Quos Non Beatae Nemo.',
                'slug' => 'aliquam-consequuntur-ab-et-veritatis-quibusdam-laborum',
                'description' => 'Dolor qui qui voluptatem. Reprehenderit accusamus alias sunt quae praesentium similique placeat.

Nobis quia molestiae quia. Aliquam rerum ex omnis harum. Repellendus corrupti eveniet eligendi voluptatem iure ipsam. Sit enim modi est iure.

Harum nisi quos tempore excepturi doloremque officia omnis. Voluptatem maiores ad nostrum sed possimus. Fuga hic est non ipsa possimus.',
                'language' => 'French',
                'image' => 'aebfe7ab578ff0aad92a511b54d48368.jpg',
                'level' => 'advanced',
                'featured' => 0,
                'price' => '121.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.4,"durationHMS":"00:30:00","total_articles":1,"total_hours":0.5,"total_published_lessons":5,"total_lessons":5,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:37:15',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            21 => 
            array (
                'id' => 22,
                'uuid' => '4e844243-0726-4fb8-89bf-afd4628c78b1',
                'user_id' => 5,
                'category_id' => 20,
                'title' => 'Hic Voluptas Id Est Saepe Maxime Nostrum.',
                'subtitle' => 'Vitae A Laborum Expedita Et.',
                'slug' => 'hic-voluptas-id-est-saepe-maxime-nostrum',
                'description' => 'Sint reprehenderit velit voluptatem minima. Commodi nihil et soluta voluptates. Assumenda aut aut sapiente eum dolores nesciunt est.

Quia nam provident eligendi accusamus consectetur nemo. Qui et dolorem sint ea placeat omnis quae. Et deleniti quisquam illo facere nulla et dolores dolores. Distinctio neque accusamus esse. Dignissimos cum aut consequatur consectetur a corrupti nihil ipsum.

Voluptatem aut quia voluptas quidem porro totam necessitatibus. Qui et impedit repudiandae repellat voluptas reprehenderit architecto. Dolor sed ex doloremque. Corrupti magnam totam facere corporis a reiciendis quasi.

Quisquam sint eos non quia et. Alias est dicta quasi. Iure accusantium commodi quia unde vitae sapiente.',
                'language' => 'French',
                'image' => '819a83e69afe83abb28d2246167694b6.jpg',
                'level' => 'intermediate',
                'featured' => 0,
                'price' => '108.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.4,"durationHMS":"00:30:00","total_articles":1,"total_hours":0.5,"total_published_lessons":6,"total_lessons":6,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:37:15',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            22 => 
            array (
                'id' => 23,
                'uuid' => '76cfed64-2b56-47d5-a62d-ed8390890e76',
                'user_id' => 5,
                'category_id' => 8,
                'title' => 'Sed Ea Vel Et Nulla Neque Non.',
                'subtitle' => 'Optio Inventore Maiores Beatae Quasi.',
                'slug' => 'sed-ea-vel-et-nulla-neque-non',
                'description' => 'Repudiandae et ut quidem itaque voluptatem doloremque. Quidem non beatae quis. Qui sapiente ratione dolore mollitia voluptas iusto. Nulla et quia qui corrupti quo delectus commodi.

Et facilis veniam deleniti ipsum. Est aliquid qui fuga. Nulla dolor laboriosam quod ipsum cumque.

Quo vel earum harum. Quo eos quisquam totam sint sit qui. Veniam sed sed qui. Nobis reiciendis eius odit reprehenderit fuga deleniti pariatur.

Illum nam quia atque dolorem eligendi eaque. Voluptas quod in ab harum quidem ipsum ut. Dolorem consequatur odit nemo ad voluptatum non earum laudantium.',
                'language' => 'Spanish',
                'image' => 'e83b351965b90d3deb5ffe3d08dc3f6b.jpg',
                'level' => 'all',
                'featured' => 0,
                'price' => '179.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.2,"durationHMS":"00:24:00","total_articles":3,"total_hours":0.4,"total_published_lessons":6,"total_lessons":6,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:37:15',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            23 => 
            array (
                'id' => 24,
                'uuid' => '7e8a40ca-6ba6-45cc-8ceb-87b1a4451223',
                'user_id' => 5,
                'category_id' => 24,
                'title' => 'Architecto In Ullam Dicta Qui.',
                'subtitle' => 'Explicabo Sapiente Velit Et Rerum.',
                'slug' => 'architecto-in-ullam-dicta-qui',
                'description' => 'Voluptatum aperiam laudantium asperiores tempora illum quos sed. Dolor dolor omnis sint velit deserunt incidunt ad. Officiis sit qui qui incidunt sed iure.

Blanditiis facere quasi aut ipsum in qui aut impedit. Non omnis aut ea similique. Recusandae eos qui explicabo.

Dolores atque et quis. Iusto molestiae quae numquam voluptatem doloremque eius. Odio aut beatae et est est vel. Ipsam laudantium voluptatum dolor ut magnam laboriosam reprehenderit veniam. Excepturi et ut molestiae nulla praesentium minus.

Quibusdam ut doloribus illum eaque dolorem ullam distinctio. Et illum tenetur esse eos neque sunt velit. Totam vitae minus quia ipsum quasi.',
                'language' => 'French',
                'image' => 'a075cc7640a58b7ec34c1fd313c3c61c.jpg',
                'level' => 'intermediate',
                'featured' => 0,
                'price' => '196.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.1,"durationHMS":"00:24:00","total_articles":2,"total_hours":0.4,"total_published_lessons":4,"total_lessons":4,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:37:15',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            24 => 
            array (
                'id' => 25,
                'uuid' => '34ead754-4b36-4a4d-9575-22fa716f059e',
                'user_id' => 5,
                'category_id' => 29,
                'title' => 'Amet Delectus Dolorem Dolor A Rerum Ut.',
                'subtitle' => 'Fuga Velit Sit Adipisci Dolorem Eos.',
                'slug' => 'amet-delectus-dolorem-dolor-a-rerum-ut',
                'description' => 'Natus ipsam id soluta molestiae. Vitae adipisci officia eum. Consequatur unde aut quisquam esse nostrum debitis molestiae. Ex corporis officia quae omnis est.

Similique sint rerum sint qui. Autem vel voluptas illo dolor et. Quia qui excepturi sit reiciendis atque amet numquam. Porro explicabo molestiae accusamus.',
                'language' => 'French',
                'image' => 'bb2d1aca89511b48822f930053fc334a.jpg',
                'level' => 'advanced',
                'featured' => 0,
                'price' => '197.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.4,"durationHMS":"00:30:00","total_articles":1,"total_hours":0.5,"total_published_lessons":5,"total_lessons":5,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:37:15',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            25 => 
            array (
                'id' => 26,
                'uuid' => '07d9b1fb-4693-4742-b552-199c4ac9edec',
                'user_id' => 5,
                'category_id' => 18,
                'title' => 'Quidem Perferendis Fugit Labore Modi.',
                'subtitle' => 'Est Magnam Voluptatibus Ut Repellat.',
                'slug' => 'quidem-perferendis-fugit-labore-modi',
                'description' => 'Et facere aut aut debitis doloremque aliquam. Quae voluptas qui tempore est aut. Quos consequatur quam nihil fugit. Officiis sunt magni aut autem ab vel vel.

Dolores numquam odit voluptas et. Delectus sunt sint sapiente blanditiis nihil ipsum ducimus.',
                'language' => 'Spanish',
                'image' => 'bac074211f0495dfbae83752a796fd63.jpg',
                'level' => 'intermediate',
                'featured' => 0,
                'price' => '145.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.7,"durationHMS":"00:54:00","total_articles":1,"total_hours":0.9,"total_published_lessons":8,"total_lessons":8,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:37:15',
                'updated_at' => '2019-09-26 21:37:16',
            ),
            26 => 
            array (
                'id' => 27,
                'uuid' => '02af2484-8914-403a-943c-740160c69ab0',
                'user_id' => 5,
                'category_id' => 3,
                'title' => 'Et Voluptas Delectus Culpa Et.',
                'subtitle' => 'Quasi Et Ipsa Vel.',
                'slug' => 'et-voluptas-delectus-culpa-et',
                'description' => 'Et aut qui magni dolorem. Blanditiis et qui consequatur optio ipsa et. Exercitationem rerum ex molestias accusamus. Dolores nisi quod earum cum eum hic excepturi natus.

In facere laudantium porro sed officia totam et. Dolor dolorum suscipit minima sint provident.',
                'language' => 'French',
                'image' => '16b9cd9e1535f64c47d40ff2ad7ab8ae.jpg',
                'level' => 'advanced',
                'featured' => 0,
                'price' => '109.00',
                'published' => 1,
                'approved' => 1,
                'settings' => '{"total_video_hours":0.3,"durationHMS":"00:48:00","total_articles":4,"total_hours":0.8,"total_published_lessons":7,"total_lessons":7,"total_unanswered_questions":0}',
                'created_at' => '2019-09-26 21:37:15',
                'updated_at' => '2019-09-26 21:37:16',
            ),
        ));
        
        
    }
}