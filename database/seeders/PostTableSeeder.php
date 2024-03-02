<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'content' => 'つぶやき',
            'like_count' => 0,
            'user_id' => 3,
            'attachment_id' => 1,
        ]);
    }
}


// mysql> desc posts
// +---------------+-----------------+------+-----+---------+----------------+
// | Field         | Type            | Null | Key | Default | Extra          |
// +---------------+-----------------+------+-----+---------+----------------+
// | id            | bigint unsigned | NO   | PRI | NULL    | auto_increment |
// | parent_id     | bigint unsigned | YES  |     | NULL    |                |
// | content       | varchar(255)    | NO   |     | NULL    |                |
// | like_count    | int             | NO   |     | NULL    |                |
// | user_id       | bigint unsigned | YES  | MUL | NULL    |                |
// | attachment_id | bigint unsigned | YES  | MUL | NULL    |                |
// | created_at    | timestamp       | YES  |     | NULL    |                |
// | updated_at    | timestamp       | YES  |     | NULL    |                |
// +---------------+-----------------+------+-----+---------+----------------+
// 8 rows in set (0.03 sec)