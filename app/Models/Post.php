<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    /**
     * Get the comments for the blog post.
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    use HasFactory;

    protected $guarded = ['id'];
}
