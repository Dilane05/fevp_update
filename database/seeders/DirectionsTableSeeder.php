<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directions = [
            ['name' => 'DUMS', 'signification' => null],
            ['name' => 'DG', 'signification' => null],
            ['name' => 'DCM', 'signification' => null],
            ['name' => 'DED', 'signification' => null],
            ['name' => 'DF', 'signification' => null],
            ['name' => 'RACS', 'signification' => null],
            ['name' => 'DRH', 'signification' => null],
            ['name' => 'UMK', 'signification' => null],
            ['name' => 'DAL', 'signification' => null],
            ['name' => 'DQS', 'signification' => null],
            ['name' => 'DSI', 'signification' => null],
            ['name' => 'DQ', 'signification' => null],
            ['name' => 'DACG', 'signification' => null],
            ['name' => 'DUP', 'signification' => null],
            ['name' => 'DQHSE', 'signification' => null],
            ['name' => 'DCH', 'signification' => null],
            ['name' => 'USINE', 'signification' => null],
            ['name' => 'MAINTENANCE', 'signification' => null],
            ['name' => 'DGA', 'signification' => null],
        ];

        foreach ($directions as $direction) {
            DB::table('directions')->updateOrInsert(
                ['name' => $direction['name']],
                array_merge($direction, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }
}
