<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment'];

    public function commentUser(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, Post::class, 'id', 'id', 'post_id', 'user_id');
    }
}
