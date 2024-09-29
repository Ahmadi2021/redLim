<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text'
    ];

    public function comments(){
        $this->hasMany(Comment::class,'post_id');
    }

    public function user(){
        $this->belongsTo(User::class,'user_id');
    }
}
