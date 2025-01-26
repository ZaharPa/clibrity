<?php

namespace App\Http\Controllers;

use App\Services\RecommendationService;
use Illuminate\Http\Request;

class RecomandationController extends Controller
{
    protected $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function recommendBooks()
    {
        $userId = auth()->id();

        $recommendatedBooks = $this->recommendationService->recommendBooksBasedOnTaste($userId);

        return response()->json($recommendatedBooks);
    }
}
