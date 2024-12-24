<?php

namespace App\Models;

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

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
