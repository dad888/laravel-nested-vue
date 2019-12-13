<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        $data2 = ['name' => $faker->word,
            'children' => [
                [
                    'name' => $faker->word,
                    'children' => [
                        [
                            'name' => $faker->word
                        ],
                    ],
                ],
            ],
        ];

        foreach (range(1,10) as $index)
        {
            \App\Models\Category::create([
                'name' => $faker->word,
                'children' => [
                    [
                        'name' => $faker->word,
                        'children' => [
                            [
                                'name' => $faker->word
                            ],
                        ],
                    ],
                ],
            ]);
        }

    }
}
