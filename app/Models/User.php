<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Follow;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'introduction'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function following()
    {
        return $this->hasMany(Follow::class, 'following_user_id');
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'followed_user_id');
    }

    // フォロー数を取得
    public function followCount($userId)
    {
        return Follow::where('following_user_id', $userId)->count();
    }

    // フォロワー数を取得
    public function followerCount($userId)
    {
        return Follow::where('followed_user_id', $userId)->count();
    }
}

// めも
// 「User.php」と「Follow.php」と「Post.php」の関係について
// 「User.php」と「Post.php」の関係は1対多の関係
// 「User.php」と「Follow.php」の関係が多対多の関係