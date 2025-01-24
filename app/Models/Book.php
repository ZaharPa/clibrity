<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = ['title', 'author', 'description', 'size', 'category', 'title_path', 'book_path'];

    protected $appends = ['title_url', 'book_url'];

    public static array $category = [
        'Fiction',
        'Non-Fiction',
        'Science Fiction',
        'Fantasy',
        'Biography',
        'Mystery',
        'Romance',
        'Thriller'
    ];

    public $sortable = [
        'title',
        'author',
        'category',
        'size',
        'created_at'
    ];

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(BookReview::class, 'book_id');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(BookNote::class, 'book_id');
    }

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    public function getTitleUrlAttribute()
    {
        return asset('storage/' . $this->title_path);
    }

    public function getBookUrlAttribute()
    {
        return asset('storage/' . $this->book_path);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when(
            $filters['title'] ?? false,
            fn($query, $value) => $query->where('title', 'like', '%' . $value . '%')
        )->when(
            $filters['author'] ?? false,
            fn($query, $value) => $query->where('author', 'like', '%' . $value . '%')
        )->when(
            $filters['category'] ?? false,
            fn($query, $category) => $query->where('category', $category)
        )->when(
            $filters['size'] ?? false,
            fn($query, $value) => $query->when(
                $value > 600,
                fn($q) => $q->where('size', '>', 600),
                fn($q) => $q->whereBetween('size', [$value, $value + 99])
            )
        );
    }
}
