<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{
    use HasFactory;
    protected $fillable = [
        'title', 'content', 'user_id', 'status', 'view_count', 'like_count', 'favorite_count', 'category_id'
    ];
    protected $table = 'posts';
}
