<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $size = ["S", "M", "L", "XL", "2XL", "3XL"];

        foreach ($size as $size) {
            Size::create([
                'size_title' => $size
            ]);
        }
    }
}
