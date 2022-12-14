<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'meta_title', 'meta_keyword', 'meta_description', 'status',
    ];
    protected $table = 'categories';

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id','id');
    }
}
