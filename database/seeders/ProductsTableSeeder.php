<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

Product::truncate();

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $faker = \Faker\Factory::create();
        //
        for ($i = 0; $i < 5; $i++) {
            $Image = $this->getImage();

            Product::create([
                'name' => $faker->word,
                'price' => $faker->randomFloat(2, 800, 20000),
                'units' => $faker->randomDigitNotZero(),
                'description' => $faker->sentences(2, 10, 10000),
                'image' => $Image,
                'color' => $this->getColor($Image),
                'size_id' => $this->getSizeId(),
                'imprint_id' => $this->getImprintId()
            ]);
        }
    }

    private function getImage()
    {
        $image = ["black-text.jpg", "grey-art.jpg", "white-art.jpg", "white-fruit.jpg", "white-text.jpg"];
        return $image[array_rand($image)];
    }

    private function getColor($image)
    {
        if (strstr($image, "white")) {
            return "white";
        } elseif (strstr($image, "black")) {
            return "black";
        } else {
            return "grey";
        }
    }

    private function getSizeId()
    {
        $size = \App\Models\Size::inRandomOrder()->first();
        return $size->id;
    }

    private function getImprintId()
    {
        $imprint = \App\Models\Imprint::inRandomOrder()->first();
        return $imprint->id;
    }
}
