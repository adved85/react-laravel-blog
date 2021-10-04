<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $appends = ['date_formatted'];

    # -- relations -- #

    /**
     * Get the post that has the current comment
     *
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * Get user whe write the current comment
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    # -- accessors -- #
    public function getFormattedDateAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('Y/m/d h:i a');
    }

}
