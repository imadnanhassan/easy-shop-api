<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('languages')->insert([
            'name' => 'English',
            'code' => 'en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
