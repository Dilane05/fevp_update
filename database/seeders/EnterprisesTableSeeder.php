<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnterprisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enterprises = [
            'PANZANI',
            'LPT',
            'SAE',
            'CADYST GROUP',
        ];

        foreach ($enterprises as $enterprise) {
            DB::table('enterprises')->updateOrInsert(
                ['name' => $enterprise],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
