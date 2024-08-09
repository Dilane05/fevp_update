<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = [
            'UMS',
            'NDOGSIMBI',
            'BAFOUSSAM',
            'MAROUA',
            'NGAOUNDERE',
            'GAROUA',
            'YAOUNDE',
            'BERTOUA',
            'UMK',
            'USINE BASSA',
            'GRAND HANGAR',
            'MAGASIN BASSA',
            'SAE',
        ];

        foreach ($sites as $site) {
            DB::table('sites')->insert([
                'name' => $site,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
