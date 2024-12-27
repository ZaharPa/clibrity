<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

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
        return $this->belongsTo(User::class);
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
            fn($query, $value) => $query->whereBetween('size', [$value, $value + 99])
        );
    }
}
