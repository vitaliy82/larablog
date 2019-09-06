<?php

namespace App\Providers;

use App\Entities\Post;
use App\Observers\PostObserver;
use App\Entities\Comment;
use App\Observers\CommentObserver;
use Illuminate\Support\ServiceProvider;
use App\Tools\StopWords;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
        Comment::observe(CommentObserver::class);

        $this->app->singleton('stopWord', function ($app) {
            return StopWords::class;
        });
    }
}
