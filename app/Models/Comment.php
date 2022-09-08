<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 'user_id', 'message','status', 'reply_id'
    ];
    protected $table = 'comments';
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function replies(){
        return $this->hasMany(Comment::class,'reply_id','id');
    }
}
