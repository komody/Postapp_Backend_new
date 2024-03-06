<?php

namespace App\UseCases\Session;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterAction
{
    public function __invoke($request)
    {
        $user = new User([
            'name' => 'name',
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'introduction' => 'introduction',
        ]);

        $user->save();

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $token = Auth::user()->createToken('AccessToken')->plainTextToken;
            return $token;
        }
    }
}

// mysql> desc users;
// +--------------------+-----------------+------+-----+---------+----------------+
// | Field              | Type            | Null | Key | Default | Extra          |
// +--------------------+-----------------+------+-----+---------+----------------+
// | id                 | bigint unsigned | NO   | PRI | NULL    | auto_increment |
// | name               | varchar(255)    | NO   |     | NULL    |                |
// | email              | varchar(255)    | NO   | UNI | NULL    |                |
// | email_verified_at  | timestamp       | YES  |     | NULL    |                |
// | password           | varchar(255)    | NO   |     | NULL    |                |
// | introduction       | varchar(255)    | NO   |     | NULL    |                |
// | icon_attachment_id | bigint unsigned | YES  |     | NULL    |                |
// | attachment_id      | bigint unsigned | YES  | MUL | NULL    |                |
// | deleted_at         | datetime        | YES  |     | NULL    |                |
// | remember_token     | varchar(100)    | YES  |     | NULL    |                |
// | created_at         | timestamp       | YES  |     | NULL    |                |
// | updated_at         | timestamp       | YES  |     | NULL    |                |
// +--------------------+-----------------+------+-----+---------+----------------+
// 12 rows in set (0.03 sec)