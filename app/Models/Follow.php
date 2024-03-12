<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'following_user_id',
        'followed_user_id',
    ];

    public function followingUser()
    {
        return $this->belongsTo(User::class, 'following_user_id');
    }

    public function followedUser()
    {
        return $this->belongsTo(User::class, 'followed_user_id');
    }
}

// めも
// 「User.php」と「Follow.php」と「Post.php」の関係について
// 「User.php」と「Post.php」の関係は1対多の関係
// 「User.php」と「Follow.php」の関係が多対多の関係