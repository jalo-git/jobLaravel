<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'JudyJesselleJessa',
            'lastname' => 'ocampo',
            'address' => 'cebu',
            'usertype' => 'admin',
            'emailAddress' => 'ocampo@gmail.com',
            'password' => Hash::make('secretsecret'),
        ]);
    }
}
