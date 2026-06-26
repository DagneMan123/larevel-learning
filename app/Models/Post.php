<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'user_id',   // ← add this
        'title',
        'body',
        'author',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    // A post belongs to one user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
