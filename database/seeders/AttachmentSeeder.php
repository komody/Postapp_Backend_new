<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attachments')->insert([
            'type' => 'jpg',
            'url' => 'sample.jpg',
            'preview_url' => 'http:localhost',
            'description' => 'これは画像です。',
        ]);
    }
}


// mysql> desc attachments;
// +-------------+-----------------+------+-----+---------+----------------+
// | Field       | Type            | Null | Key | Default | Extra          |
// +-------------+-----------------+------+-----+---------+----------------+
// | id          | bigint unsigned | NO   | PRI | NULL    | auto_increment |
// | type        | varchar(255)    | NO   |     | NULL    |                |
// | url         | varchar(255)    | NO   |     | NULL    |                |
// | preview_url | varchar(255)    | NO   |     | NULL    |                |
// | description | varchar(255)    | NO   |     | NULL    |                |
// | created_at  | timestamp       | YES  |     | NULL    |                |
// | updated_at  | timestamp       | YES  |     | NULL    |                |
// +-------------+-----------------+------+-----+---------+----------------+
// 7 rows in set (0.03 sec)