<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $appends = ['image_url', 'date_formatted', 'excerpt'];

    # -- accessors -- #
    public function getImageUrlAttribute(): string
    {
        return $this->image ? url('upload/' . $this->image) : '';
    }

    public function getDateFormattedAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('F d, Y');
    }

    public function getExcerptAttribute(): string
    {
        return substr(strip_tags($this->content), 0, 100);
    }

    # --- relations --- #
    /**
     * Get the category that belongs to current post
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the user who created current post
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all tags belong to current post
     *
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('post_tag', 'post_id', 'tag_id');
    }

    /**
     * Get all comments of current post
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }

    # -- filters -- #
    /**
     * approved comments to be displayed on react website under current post
     *
     * @return HasMany
     */
    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id')->with('user', 'post')->where('approved', 1);
    }
}
