<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(User $profile)
    {
        $profile->loadCount('reviews', 'notes', 'publishedBooks');

        $books = $profile->notes()
            ->where('favorite', true)
            ->with('book')
            ->paginate(10);

        return inertia('Profile/Show', [
            'profile' => $profile,
            'books' => $books,
            'canControl' => Auth::check()
                ? Auth::user()->can('update', $profile)
                : false
        ]);
    }

    public function edit(User $profile)
    {
        Gate::authorize('update', $profile);
        return inertia('Profile/Edit', ['profile' => $profile]);
    }

    public function update(Request $request, User $profile)
    {
        Gate::authorize('update', $profile);

        $request->validate([
            'name' => 'nullable|string',
            'password_old' => 'required|string|min:8',
            'password_new' => 'nullable|string|min:8'
        ]);

        if (!Hash::check($request->password_old, $profile->password)) {
            return back()->withErrors(['password_old' => 'Old password is incorrect']);
        }

        if ($request->filled('name')) {
            $profile->name = $request->name;
        }

        if ($request->filled('password_new')) {
            $profile->password = Hash::make($request->password_new);
        }

        $profile->save();

        return redirect()->route('profile.show', ['profile' => $profile])->with('success', 'Profile updated successfully');
    }

    public function destroy(User $profile)
    {
        Gate::authorize('delete', $profile);

        $profile->delete();

        return redirect()->route('book.index')->with('success', 'Account delete successfully');
    }
}
