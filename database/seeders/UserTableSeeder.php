<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'post backend',
            'email' => 'post@example.com',
            'password' => bcrypt('password'),
            'introduction' => 'aaa',
            'icon_attachment_id' => 0,
        ]);
    }
}
