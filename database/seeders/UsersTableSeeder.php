<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'admin',
            'lastname' => 'admin',
            'phone' => '95660686',
            'password' => Hash::make('Hackthon@2020'),
            'commune_id' => '1',
            'rule' => 'admin',
        ]);

        DB::table('users')->insert([
            'firstname' => 'Hackacthon',
            'lastname' => 'ANCIB',
            'phone' => '66088697',
            'password' => Hash::make('Hackthon@2020'),
            'commune_id' => '1',
            'rule' => 'admin_locaux',
        ]);
    }
}
