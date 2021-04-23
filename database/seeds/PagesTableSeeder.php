<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => '{"en":"About us","fr":"\\u00c0 propos de nous"}',
                'uuid' => 'bd7070b1-07d2-442b-adf7-937ab3983796',
                'slug' => 'about-us',
                'meta_description' => NULL,
                'body' => '{"en":"<p class=\\"ql-align-justify\\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ante mi, convallis a lacinia at, pulvinar ut metus. Curabitur convallis facilisis pellentesque. Proin tristique tellus et tincidunt euismod. Maecenas ut rutrum magna, sit amet vestibulum libero. Fusce rhoncus eget dolor sed sollicitudin. In vel dignissim urna. Sed imperdiet, nisl fringilla volutpat sollicitudin, mi mauris bibendum ligula, a dictum nibh lorem sed turpis. Aenean pulvinar tellus nec lectus pulvinar, lacinia lacinia orci ultricies. Aliquam vulputate tellus sapien, quis hendrerit leo aliquet sed. Vivamus et viverra quam, non sollicitudin ligula. Aliquam in sollicitudin diam, a fermentum magna.<\\/p><p class=\\"ql-align-justify\\"><br><\\/p><p class=\\"ql-align-justify\\">Praesent dignissim gravida urna eget ullamcorper. Quisque placerat laoreet diam, in aliquet justo laoreet eu. Duis eget euismod erat. Nulla vulputate elit maximus velit ultricies suscipit. Fusce luctus ex sed sagittis commodo. Vestibulum et euismod est, iaculis rutrum metus. Pellentesque ac semper sapien. Maecenas mattis ex nec malesuada laoreet. Donec condimentum sit amet diam vitae ultricies.<\\/p><p class=\\"ql-align-justify\\"><br><\\/p><p class=\\"ql-align-justify\\">Morbi a mollis ante. Curabitur sagittis, metus sed sagittis cursus, sapien ipsum placerat sapien, a posuere velit nunc et turpis. Donec orci erat, bibendum sit amet sem at, rutrum dignissim arcu. Aliquam a egestas quam. Proin sit amet mauris sit amet massa hendrerit pretium. Curabitur vitae tortor condimentum, hendrerit augue sit amet, dapibus mi. Mauris lobortis in ligula ac dapibus. Nulla pulvinar magna non semper aliquam. Cras varius sodales sapien, at volutpat quam porta id. Integer gravida, lacus in porta scelerisque, quam mi laoreet dolor, quis consectetur orci nibh in velit.<\\/p><p><br><\\/p>","fr":"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ante mi, convallis a lacinia at, pulvinar ut metus. Curabitur convallis facilisis pellentesque. Proin tristique tellus et tincidunt euismod. Maecenas ut rutrum magna, sit amet vestibulum libero. Fusce rhoncus eget dolor sed sollicitudin. In vel dignissim urna. Sed imperdiet, nisl fringilla volutpat sollicitudin, mi mauris bibendum ligula, a dictum nibh lorem sed turpis. Aenean pulvinar tellus nec lectus pulvinar, lacinia lacinia orci ultricies. Aliquam vulputate tellus sapien, quis hendrerit leo aliquet sed. Vivamus et viverra quam, non sollicitudin ligula. Aliquam in sollicitudin diam, a fermentum magna.<\\/p><p><br><\\/p><p>Praesent dignissim gravida urna eget ullamcorper. Quisque placerat laoreet diam, in aliquet justo laoreet eu. Duis eget euismod erat. Nulla vulputate elit maximus velit ultricies suscipit. Fusce luctus ex sed sagittis commodo. Vestibulum et euismod est, iaculis rutrum metus. Pellentesque ac semper sapien. Maecenas mattis ex nec malesuada laoreet. Donec condimentum sit amet diam vitae ultricies.<\\/p><p><br><\\/p><p>Morbi a mollis ante. Curabitur sagittis, metus sed sagittis cursus, sapien ipsum placerat sapien, a posuere velit nunc et turpis. Donec orci erat, bibendum sit amet sem at, rutrum dignissim arcu. Aliquam a egestas quam. Proin sit amet mauris sit amet massa hendrerit pretium. Curabitur vitae tortor condimentum, hendrerit augue sit amet, dapibus mi. Mauris lobortis in ligula ac dapibus. Nulla pulvinar magna non semper aliquam. Cras varius sodales sapien, at volutpat quam porta id. Integer gravida, lacus in porta scelerisque, quam mi laoreet dolor, quis consectetur orci nibh in velit.<\\/p><p><br><\\/p>"}',
                'featured_image' => NULL,
                'featured' => 0,
                'published' => 1,
                'published_at' => NULL,
                'created_at' => '2019-09-26 22:05:50',
                'updated_at' => '2019-10-13 17:31:10',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => '{"en":"Terms of Service","fr":"Conditions d\'utilisation"}',
                'uuid' => 'd96b54e3-879a-4359-968b-f6b8199f9ae3',
                'slug' => 'terms-of-service',
                'meta_description' => NULL,
                'body' => '{"en":"<p class=\\"ql-align-justify\\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ante mi, convallis a lacinia at, pulvinar ut metus. Curabitur convallis facilisis pellentesque. Proin tristique tellus et tincidunt euismod. Maecenas ut rutrum magna, sit amet vestibulum libero. Fusce rhoncus eget dolor sed sollicitudin. In vel dignissim urna. Sed imperdiet, nisl fringilla volutpat sollicitudin, mi mauris bibendum ligula, a dictum nibh lorem sed turpis. Aenean pulvinar tellus nec lectus pulvinar, lacinia lacinia orci ultricies. Aliquam vulputate tellus sapien, quis hendrerit leo aliquet sed. Vivamus et viverra quam, non sollicitudin ligula. Aliquam in sollicitudin diam, a fermentum magna.<\\/p><p class=\\"ql-align-justify\\"><br><\\/p><p class=\\"ql-align-justify\\">Praesent dignissim gravida urna eget ullamcorper. Quisque placerat laoreet diam, in aliquet justo laoreet eu. Duis eget euismod erat. Nulla vulputate elit maximus velit ultricies suscipit. Fusce luctus ex sed sagittis commodo. Vestibulum et euismod est, iaculis rutrum metus. Pellentesque ac semper sapien. Maecenas mattis ex nec malesuada laoreet. Donec condimentum sit amet diam vitae ultricies.<\\/p><p class=\\"ql-align-justify\\"><br><\\/p><p class=\\"ql-align-justify\\">Morbi a mollis ante. Curabitur sagittis, metus sed sagittis cursus, sapien ipsum placerat sapien, a posuere velit nunc et turpis. Donec orci erat, bibendum sit amet sem at, rutrum dignissim arcu. Aliquam a egestas quam. Proin sit amet mauris sit amet massa hendrerit pretium. Curabitur vitae tortor condimentum, hendrerit augue sit amet, dapibus mi. Mauris lobortis in ligula ac dapibus. Nulla pulvinar magna non semper aliquam. Cras varius sodales sapien, at volutpat quam porta id. Integer gravida, lacus in porta scelerisque, quam mi laoreet dolor, quis consectetur orci nibh in velit.<\\/p><p><br><\\/p>","fr":"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ante mi, convallis a lacinia at, pulvinar ut metus. Curabitur convallis facilisis pellentesque. Proin tristique tellus et tincidunt euismod. Maecenas ut rutrum magna, sit amet vestibulum libero. Fusce rhoncus eget dolor sed sollicitudin. In vel dignissim urna. Sed imperdiet, nisl fringilla volutpat sollicitudin, mi mauris bibendum ligula, a dictum nibh lorem sed turpis. Aenean pulvinar tellus nec lectus pulvinar, lacinia lacinia orci ultricies. Aliquam vulputate tellus sapien, quis hendrerit leo aliquet sed. Vivamus et viverra quam, non sollicitudin ligula. Aliquam in sollicitudin diam, a fermentum magna.<\\/p><p><br><\\/p><p>Praesent dignissim gravida urna eget ullamcorper. Quisque placerat laoreet diam, in aliquet justo laoreet eu. Duis eget euismod erat. Nulla vulputate elit maximus velit ultricies suscipit. Fusce luctus ex sed sagittis commodo. Vestibulum et euismod est, iaculis rutrum metus. Pellentesque ac semper sapien. Maecenas mattis ex nec malesuada laoreet. Donec condimentum sit amet diam vitae ultricies.<\\/p><p><br><\\/p><p>Morbi a mollis ante. Curabitur sagittis, metus sed sagittis cursus, sapien ipsum placerat sapien, a posuere velit nunc et turpis. Donec orci erat, bibendum sit amet sem at, rutrum dignissim arcu. Aliquam a egestas quam. Proin sit amet mauris sit amet massa hendrerit pretium. Curabitur vitae tortor condimentum, hendrerit augue sit amet, dapibus mi. Mauris lobortis in ligula ac dapibus. Nulla pulvinar magna non semper aliquam. Cras varius sodales sapien, at volutpat quam porta id. Integer gravida, lacus in porta scelerisque, quam mi laoreet dolor, quis consectetur orci nibh in velit.<\\/p><p><br><\\/p>"}',
                'featured_image' => NULL,
                'featured' => 0,
                'published' => 1,
                'published_at' => NULL,
                'created_at' => '2019-09-26 22:06:13',
                'updated_at' => '2019-10-13 17:30:37',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => '{"en":"Privacy Policy","fr":"Politique de confidentialit\\u00e9"}',
                'uuid' => '1ab8a6c0-b43b-423f-9f11-729a507c0a6e',
                'slug' => 'privacy-policy',
                'meta_description' => NULL,
                'body' => '{"en":"<p class=\\"ql-align-justify\\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ante mi, convallis a lacinia at, pulvinar ut metus. Curabitur convallis facilisis pellentesque. Proin tristique tellus et tincidunt euismod. Maecenas ut rutrum magna, sit amet vestibulum libero. Fusce rhoncus eget dolor sed sollicitudin. In vel dignissim urna. Sed imperdiet, nisl fringilla volutpat sollicitudin, mi mauris bibendum ligula, a dictum nibh lorem sed turpis. Aenean pulvinar tellus nec lectus pulvinar, lacinia lacinia orci ultricies. Aliquam vulputate tellus sapien, quis hendrerit leo aliquet sed. Vivamus et viverra quam, non sollicitudin ligula. Aliquam in sollicitudin diam, a fermentum magna.<\\/p><p class=\\"ql-align-justify\\"><br><\\/p><p class=\\"ql-align-justify\\">Praesent dignissim gravida urna eget ullamcorper. Quisque placerat laoreet diam, in aliquet justo laoreet eu. Duis eget euismod erat. Nulla vulputate elit maximus velit ultricies suscipit. Fusce luctus ex sed sagittis commodo. Vestibulum et euismod est, iaculis rutrum metus. Pellentesque ac semper sapien. Maecenas mattis ex nec malesuada laoreet. Donec condimentum sit amet diam vitae ultricies.<\\/p><p class=\\"ql-align-justify\\"><br><\\/p><p class=\\"ql-align-justify\\">Morbi a mollis ante. Curabitur sagittis, metus sed sagittis cursus, sapien ipsum placerat sapien, a posuere velit nunc et turpis. Donec orci erat, bibendum sit amet sem at, rutrum dignissim arcu. Aliquam a egestas quam. Proin sit amet mauris sit amet massa hendrerit pretium. Curabitur vitae tortor condimentum, hendrerit augue sit amet, dapibus mi. Mauris lobortis in ligula ac dapibus. Nulla pulvinar magna non semper aliquam. Cras varius sodales sapien, at volutpat quam porta id. Integer gravida, lacus in porta scelerisque, quam mi laoreet dolor, quis consectetur orci nibh in velit.<\\/p><p><br><\\/p>","fr":"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ante mi, convallis a lacinia at, pulvinar ut metus. Curabitur convallis facilisis pellentesque. Proin tristique tellus et tincidunt euismod. Maecenas ut rutrum magna, sit amet vestibulum libero. Fusce rhoncus eget dolor sed sollicitudin. In vel dignissim urna. Sed imperdiet, nisl fringilla volutpat sollicitudin, mi mauris bibendum ligula, a dictum nibh lorem sed turpis. Aenean pulvinar tellus nec lectus pulvinar, lacinia lacinia orci ultricies. Aliquam vulputate tellus sapien, quis hendrerit leo aliquet sed. Vivamus et viverra quam, non sollicitudin ligula. Aliquam in sollicitudin diam, a fermentum magna.<\\/p><p><br><\\/p><p>Praesent dignissim gravida urna eget ullamcorper. Quisque placerat laoreet diam, in aliquet justo laoreet eu. Duis eget euismod erat. Nulla vulputate elit maximus velit ultricies suscipit. Fusce luctus ex sed sagittis commodo. Vestibulum et euismod est, iaculis rutrum metus. Pellentesque ac semper sapien. Maecenas mattis ex nec malesuada laoreet. Donec condimentum sit amet diam vitae ultricies.<\\/p><p><br><\\/p><p>Morbi a mollis ante. Curabitur sagittis, metus sed sagittis cursus, sapien ipsum placerat sapien, a posuere velit nunc et turpis. Donec orci erat, bibendum sit amet sem at, rutrum dignissim arcu. Aliquam a egestas quam. Proin sit amet mauris sit amet massa hendrerit pretium. Curabitur vitae tortor condimentum, hendrerit augue sit amet, dapibus mi. Mauris lobortis in ligula ac dapibus. Nulla pulvinar magna non semper aliquam. Cras varius sodales sapien, at volutpat quam porta id. Integer gravida, lacus in porta scelerisque, quam mi laoreet dolor, quis consectetur orci nibh in velit.<\\/p><p><br><\\/p>"}',
                'featured_image' => NULL,
                'featured' => 0,
                'published' => 1,
                'published_at' => NULL,
                'created_at' => '2019-09-26 22:06:36',
                'updated_at' => '2019-10-13 17:30:02',
            ),
        ));
        
        
    }
}