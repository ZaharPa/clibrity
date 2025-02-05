<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use App\Policies\AddedByUserPolicy;
use App\Policies\PostPolicy;
use App\Policies\ProfilePolicy;
use App\Policies\TopicPolicy;
use App\Services\RecommendationService;
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
        $this->app->singleton(RecommendationService::class, function ($app) {
            return new RecommendationService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, ProfilePolicy::class);
        Gate::policy(Book::class, AddedByUserPolicy::class);
        Gate::policy(Topic::class, TopicPolicy::class);
        Gate::policy(Post::class, PostPolicy::class);

        Inertia::share([
            'user' => fn() => Auth::check() ? Auth::user() : null,
        ]);
    }
}
