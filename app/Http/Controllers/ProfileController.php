<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $profile)
    {
        $profile->loadCount('reviews', 'notes', 'publishedBooks');
        return inertia('Profile/Show', ['user' => $profile]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
