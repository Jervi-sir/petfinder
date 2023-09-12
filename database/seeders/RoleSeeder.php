<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'admin'
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'manager'
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'user'
        ]);
        DB::table('roles')->insert([
            'id' => 4,
            'name' => 'vet'
        ]);
    }
}
