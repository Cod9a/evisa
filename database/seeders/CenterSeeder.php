<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Center;
use Illuminate\Support\Facades\DB;

class CenterSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
         DB::table('centers')->insert([
            ['name' => 'Ambassade du Cameroun en France (AMBACAM)', 'slug' => 'ambassade-du-cameroun-en-france', 'countries_for' => 'FR,BE', 'address' => "adresse : 73 Rue d'Auteuil, 75016 Paris France"],
            ['name' => 'Consulat Général du Cameroun au Nigéria', 'slug' => 'consulat-general-du-cameroun-au-nigeria', 'countries_for' => 'NG,BJ', 'address' => "adresse  5, Elsie Ferni Pearse Street, P.M.B 2476, Victoria Island, Lagos, Nigeria "],
        ]);
    }
}
