<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Imprint;
use App\Models\Product;
use App\Models\Size;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ImprintsTableSeeder::class);
        $this->call(SizesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
