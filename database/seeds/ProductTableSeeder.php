<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1,60) as $index)
        {
            Product::create([
               'category_id' => Category::orderByRaw('RAND()')->first()->id,
                'name' => $faker->word,
                'slug' => $faker->word,
                'image'=>$faker->imageUrl($width = 640, $height = 480)
            ]);
        }
    }
}
