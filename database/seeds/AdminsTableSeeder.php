<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < 10; $i++) {
            \App\Models\News::insert([
                'title' => 'title ' . $i,
                'content' => '<p>Ronaldo Is the best player in the <em><strong>world</strong></em></p>',
                'image' => 'news/e2X4zHu29TRFmZH8.jpeg',
                'sub_images' => '["news\/\/Et4rVzvmux4LtHN6.jpg","news\/\/Ahdp5xgy5d6gaE5g.jpg"]',
                'category_id' => rand(1,3)
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            App\Models\Category::create([
                'name' => 'category ' . $i,
            ]);
        }
    }
}
