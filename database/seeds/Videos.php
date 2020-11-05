<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Videos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $images = [
            '1602057086X7OKxqMPmn.jpg',
            '1602057105k834xXdrgi.jpg',
            '1602056871ygwfTJF4yZ.jpg',
            '1602057144ZbLVviiTSo.jpg',
            '1602057161PugI6L8Bgm.jpg',
            '1602057191pZdpozNi0B.jpg',
            '1600640444Oss009jK1g.jpg',
        ];

        $youtube = [
            'https://www.youtube.com/watch?v=DxAGg77K6gg',
            'https://www.youtube.com/watch?v=Q0wIO8Y1yzw&t=181s',
            'https://www.youtube.com/watch?v=ZdAobRx0Dag',
            'https://www.youtube.com/watch?v=GlEKvonWaH4',
            'https://www.youtube.com/watch?v=iovlUtMzM-c',
            'https://www.youtube.com/watch?v=VZYyEhMhtqY',
            'https://www.youtube.com/watch?v=nbjUKZxlLxM',
            'https://www.youtube.com/watch?v=Ay6Mq6QAFTs',
            'https://www.youtube.com/watch?v=UOXZrP-Cpg0',
            'https://www.youtube.com/watch?v=sRDFil3T6HU',
        ];

        $ids = [1,2,3,4,5,6,7,8,9];

        for($i = 0 ;$i< 50 ;$i++){
            $array = [
                'name' => $faker->word,
                'meta_keywords' => $faker->name,
                'meta_des' => $faker->name,
                'cat_id' => 1,
                'youtube' => $youtube[rand(0,9)],
                'published' => rand(0,1),
                'image' => $images[rand(0,6)],
                'des' => $faker->paragraph,
                'user_id' => 1
            ];
            $video = \App\Models\Video::create($array);
            $video->skills()->sync(array_rand($ids , 2));
            $video->tags()->sync(array_rand($ids , 3));
        }
    }
}
