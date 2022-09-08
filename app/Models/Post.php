<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{
    use HasFactory;
    protected $fillable = [
        'title', 'content', 'user_id', 'status', 'view_count', 'like_count', 'favorite_count', 'category_id', 'ima'
    ];
    protected $table = 'posts';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes(){
        return $this->hasMany(Like::class,'post_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'post_id','id')->orderBy('id','desc');
    }
}
