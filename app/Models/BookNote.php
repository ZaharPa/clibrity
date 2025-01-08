<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookNote extends Model
{
    /** @use HasFactory<\Database\Factories\BookNoteFactory> */
    use HasFactory;

    protected $fillable = ['status', 'notes', 'book_id', 'favorite'];

    protected $sortable = ['updated_at'];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterByStatus(Builder $query, string|null $status): Builder
    {
        return $query->when(
            $status ?? false,
            fn($query, $value) => $query->where('status', $value)
        );
    }
}
