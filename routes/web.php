<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('', fn() => to_route('books.index'));

Route::resource('books', BookController::class)
    ->only(['index', 'show']);
