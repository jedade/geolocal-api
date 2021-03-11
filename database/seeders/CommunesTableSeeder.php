<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CommunesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

        DB::table('communes')->insert([
            'name' => 'Avrankou',
        ]);
        DB::table('communes')->insert([
            'name' => 'Toffo',
        ]);
        DB::table('communes')->insert([
            'name' => 'Banikora',
        ]);
        DB::table('communes')->insert([
            'name' => 'Bohicon',
        ]);
    }
}
