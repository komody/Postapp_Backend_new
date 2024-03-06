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
