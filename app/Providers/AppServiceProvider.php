<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\User;
use App\Policies\AddedByUserPolicy;
use App\Policies\ProfilePolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, ProfilePolicy::class);
        Gate::policy(Book::class, AddedByUserPolicy::class);

        Inertia::share([
            'user' => fn() => Auth::check() ? Auth::user() : null,
        ]);
    }
}
