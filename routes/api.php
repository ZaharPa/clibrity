<?php

use App\Http\Controllers\BookNoteController;
use App\Http\Controllers\BookReviewController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TopicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/book/status', [BookNoteController::class, 'updateStatus'])
        ->name('book.status');
    Route::delete('/book/status/delete', [BookNoteController::class, 'deleteStatus'])
        ->name('book.status.delete');

    Route::post('/book/notes', [BookNoteController::class, 'updateNotes'])
        ->name('book.notes');

    Route::post('/book/favorite', [BookNoteController::class, 'updateFavorite'])
        ->name('book.favorite');

    Route::post('/book/review', BookReviewController::class)
        ->name('book.review');

    Route::post('/topics', [TopicController::class, 'store'])
        ->name('topics.store');
    Route::delete('/topics/{topic}', [TopicController::class, 'destroy'])
        ->name('topics.destroy');

    Route::get('/topics/{topic}/posts', [PostController::class, 'index'])
        ->name('posts.index');
    Route::post('/topics/{topic}/posts', [PostController::class, 'store'])
        ->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy');
});
