<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function create()
    {
        return inertia('Registration/Create');
    }

    public function store(Request $request)
    {
        $user = User::make($request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]));
        $user->save();

        Auth::login($user);
        event(new Registered($user));

        return redirect()->route('book.index')
            ->with('success', 'Account created!');
    }
}
