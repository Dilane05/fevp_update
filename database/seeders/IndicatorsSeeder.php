<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndicatorsSeeder extends Seeder
{
    public function run()
    {
        DB::table('indicators')->insert([
            ['id' => 1, 'name' => 'performance', 'min_value' => 0, 'max_value' => 80, 'min_score' => 0, 'max_score' => 0, 'condition_type' => 'range', 'created_at' => '2024-08-13 13:36:39', 'updated_at' => '2024-08-13 13:36:39'],
            ['id' => 2, 'name' => 'performance', 'min_value' => 80, 'max_value' => 100, 'min_score' => 50, 'max_score' => 100, 'condition_type' => 'range', 'created_at' => '2024-08-13 13:37:24', 'updated_at' => '2024-08-13 13:37:24'],
            ['id' => 3, 'name' => 'performance', 'min_value' => 100, 'max_value' => 110, 'min_score' => 100, 'max_score' => 105, 'condition_type' => 'range', 'created_at' => '2024-08-13 13:37:48', 'updated_at' => '2024-08-13 13:37:48'],
            ['id' => 4, 'name' => 'performance', 'min_value' => 110, 'max_value' => 1000, 'min_score' => 105, 'max_score' => 105, 'condition_type' => 'range', 'created_at' => '2024-08-13 13:38:02', 'updated_at' => '2024-08-13 13:38:02'],
            ['id' => 5, 'name' => 'execution', 'min_value' => 0, 'max_value' => 79.99, 'min_score' => 0, 'max_score' => 0, 'condition_type' => 'range', 'created_at' => '2024-08-13 13:38:43', 'updated_at' => '2024-08-13 13:38:43'],
            ['id' => 6, 'name' => 'execution', 'min_value' => 80, 'max_value' => 100, 'min_score' => 50, 'max_score' => 100, 'condition_type' => 'range', 'created_at' => '2024-08-13 13:39:00', 'updated_at' => '2024-08-13 13:39:00'],
            ['id' => 7, 'name' => 'budget', 'min_value' => 0, 'max_value' => 84.99, 'min_score' => 105, 'max_score' => 80, 'condition_type' => 'range', 'created_at' => '2024-08-13 13:39:41', 'updated_at' => '2024-08-13 13:39:41'],
            ['id' => 8, 'name' => 'budget', 'min_value' => 85, 'max_value' => 100, 'min_score' => 105, 'max_score' => 80, 'condition_type' => 'range', 'created_at' => '2024-08-13 13:40:07', 'updated_at' => '2024-08-13 13:40:07'],
            ['id' => 9, 'name' => 'budget', 'min_value' => 105, 'max_value' => 1000, 'min_score' => 0, 'max_score' => 0, 'condition_type' => 'range', 'created_at' => '2024-08-13 13:40:25', 'updated_at' => '2024-08-13 13:40:25'],
            ['id' => 10, 'name' => 'reputation', 'min_value' => 0, 'max_value' => 0, 'min_score' => 100, 'max_score' => 100, 'condition_type' => 'range', 'created_at' => '2024-08-13 13:40:47', 'updated_at' => '2024-08-13 13:40:47'],
            ['id' => 11, 'name' => 'reputation', 'min_value' => 0, 'max_value' => 100, 'min_score' => 100, 'max_score' => 0, 'condition_type' => 'range', 'created_at' => '2024-08-13 13:41:07', 'updated_at' => '2024-08-13 13:41:07'],
            ['id' => 12, 'name' => 'reputation', 'min_value' => 101, 'max_value' => 1000, 'min_score' => 0, 'max_score' => 0, 'condition_type' => 'range', 'created_at' => '2024-08-13 13:41:22', 'updated_at' => '2024-08-13 13:41:22'],
        ]);
    }
}
