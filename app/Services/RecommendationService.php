<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RecommendationService
{
    public function findSimilarUsers($userId)
    {
        return DB::table('book_reviews as br1')
            ->join('book_reviews as br2', 'br1.book_id', '=', 'br2.book_id')
            ->select('br2.user_id as similar_user', DB::raw('
                SUM(br1.rating * br2.rating) /
                (SQRT(SUM(POW(br1.rating, 2))) * SQRT(SUM(POW(br2.rating, 2)))) as similarity
            '))
            ->where('br1.user_id', $userId)
            ->where('br2.user_id', '!=', $userId)
            ->groupBy('br2.user_id')
            ->having('similarity', '>', 0.5)
            ->orderBy('similarity', 'desc')
            ->pluck('similar_user');
    }

    public function recommendBooksBasedOnTaste($userId)
    {
        $similarUsers = $this->findSimilarUsers($userId);

        return Book::select(
                'books.id',
                'books.title',
                'books.author',
                'books.category',
                'books.size',
                'books.title_path',
                DB::raw('
                    AVG(book_reviews.rating) as avg_rating
            '))
            ->join('book_reviews', 'books.id', '=', 'book_reviews.book_id')
            ->whereIn('book_reviews.user_id', $similarUsers)
            ->whereNotIn('books.id', function ($query) use ($userId) {
                $query->select('book_id')
                    ->from('book_reviews')
                    ->where('user_id', $userId);
            })
            ->groupBy('books.id', 'books.title','books.author',
                'books.category', 'books.size', 'books.title_path',)
            ->orderBy('avg_rating', 'desc')
            ->take(6)
            ->get();
    }
}
