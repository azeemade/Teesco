<?php

namespace Database\Seeders;

use App\Models\Imprint;
use Illuminate\Database\Seeder;

class ImprintsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $imprint = ["Text", "Animal", "Cartoon", "Plant", "Sport", "Person", "Others"];

        foreach ($imprint as $imprint) {
            Imprint::create([
                'imprint_title' => $imprint
            ]);
        }
    }
}
