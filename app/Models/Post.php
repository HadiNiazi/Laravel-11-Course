<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $table = 'blog_posts';

    // protected $primaryKey = 'post_id';

    protected $fillable = ['title', 'description', 'status', 'image'];

    // protected $guarded = [];
}
