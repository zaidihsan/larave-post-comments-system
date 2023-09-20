<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Get the comments for the blog post.
     */
  
     public function user():belongsTo
     {
         return $this->belongsTo(user::class ,'user_id');
     }


    use HasFactory;
    
    protected $fillable = ['title', 'message'];


}