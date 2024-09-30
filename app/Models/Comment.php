<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'parent_id', 'user_id', 'comment'];

    public function post(){
        $this->belongsTo(Post::class,'post_id');
    }


    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relationship to children comments (if the comment has replies)
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Relationship to the user who made the comment
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
