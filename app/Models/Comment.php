<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'comment'
    ];

    public function post(){
        $this->belongsTo(Post::class,'post_id');
    }
}
