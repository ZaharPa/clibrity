<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    /** @use HasFactory<\Database\Factories\TopicFactory> */
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id', 'book_id'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeFilter(Builder $query, $filter): Builder
    {
        return $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where(function($query) use ($search) {
                $query->where('topics.title', 'LIKE', "%$search%")
                    ->orWhereHas('book', function($query) use ($search) {
                        $query->where('books.title', 'LIKE', "%$search%");
                    });
            });
        });
    }
}
