<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    /** @use HasFactory<\Database\Factories\LikeFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'post_id'];
    public $touches = [];

    public function liking(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function liked(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
