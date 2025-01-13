<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AddedByUserPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Book $book): bool
    {
        return $user->id == $book->user_id;
    }

    public function delete(User $user, Book $book): bool
    {
        return $user->id == $book->user_id;
    }
}
