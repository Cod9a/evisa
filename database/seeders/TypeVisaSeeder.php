<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeVisa;
use Illuminate\Support\Facades\DB;

class TypeVisaSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('type_visas')->insert([
            ['name' => 'Visa touriste', 'slug' => 'visa-touriste', 'price' => 35000],
            ['name' => 'Visa de travail', 'slug' => 'visa-travail', 'price' => 40000],
            ['name' => 'Prorogation', 'slug' => 'prorogation', 'price' => 25000],
        ]);

    }
}
